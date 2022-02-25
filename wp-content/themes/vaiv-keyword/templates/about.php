<?php

/**
 * Template Name: About Page
 */

get_header();
?>
<!-- Styles -->
<style>
  #chartdiv {
    width: 100%;
    height: 415px;
    max-width: 100%;
    position: absolute;
    bottom: 0;
    opacity: 0.2;
  }

  @media (max-width: 767.98px) {
    #chartdiv {
      height: 200px;
      top: 0;
      bottom: auto;
    }
  }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
  am5.ready(function() {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");


    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);


    // Generate random data
    var value = 100;

    function generateChartData() {
      var chartData = [];
      var firstDate = new Date();
      firstDate.setDate(firstDate.getDate() - 1000);
      firstDate.setHours(0, 0, 0, 0);

      for (var i = 0; i < 50; i++) {
        var newDate = new Date(firstDate);
        newDate.setSeconds(newDate.getSeconds() + i);

        // value += (Math.random() < 0.5 ? 1 : -1) * Math.random() * 10;
        value += (Math.random() < 0.5 ? 1 : -1) * Math.random() * 1;

        chartData.push({
          date: newDate.getTime(),
          value: value
        });
      }
      return chartData;
    }

    var data = generateChartData();


    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
      focusable: true,
      panX: true,
      panY: true,
      wheelX: "panX",
      wheelY: "zoomX"
    }));

    var easing = am5.ease.linear;


    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
      maxDeviation: 0.5,
      groupData: false,
      extraMax: 0.1, // this adds some space in front
      extraMin: -0.1, // this removes some space form th beginning so that the line would not be cut off
      baseInterval: {
        timeUnit: "second",
        count: 1
      },
      renderer: am5xy.AxisRendererX.new(root, {

      }),
      tooltip: am5.Tooltip.new(root, {}),

    }));


    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
      renderer: am5xy.AxisRendererY.new(root, {

      })
    }));


    // Grid
    var yRenderer = yAxis.get("renderer");
    yRenderer.grid.template.setAll({
      stroke: am5.color(0xFFFFFF),
      strokeWidth: 0
    });

    var xRenderer = xAxis.get("renderer");
    xRenderer.grid.template.setAll({
      stroke: am5.color(0xFFFFFF),
      strokeWidth: 0
    });



    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    var series = chart.series.push(am5xy.LineSeries.new(root, {
      name: "Series 1",
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      valueXField: "date",
      fill: am5.color(0x0F94FA),
      stroke: am5.color(0x0F94FA),
      tooltip: am5.Tooltip.new(root, {
        pointerOrientation: "horizontal",
        labelText: "{valueY}"
      })
    }));

    // tell that the last data item must create bullet
    data[data.length - 1].bullet = true;
    series.data.setAll(data);


    // Create animating bullet by adding two circles in a bullet container and
    // animating radius and opacity of one of them.
    series.bullets.push(function(root, series, dataItem) {
      // only create sprite if bullet == true in data context
      if (dataItem.dataContext.bullet) {
        var container = am5.Container.new(root, {});
        var circle0 = container.children.push(am5.Circle.new(root, {
          radius: 5,
          fill: am5.color(0x0F94FA)
        }));
        var circle1 = container.children.push(am5.Circle.new(root, {
          radius: 5,
          fill: am5.color(0xff0000)
        }));

        circle1.animate({
          key: "radius",
          to: 20,
          duration: 1000,
          easing: am5.ease.out(am5.ease.cubic),
          loops: Infinity
        });
        circle1.animate({
          key: "opacity",
          to: 0,
          from: 1,
          duration: 1000,
          easing: am5.ease.out(am5.ease.cubic),
          loops: Infinity
        });

        return am5.Bullet.new(root, {
          locationX: undefined,
          sprite: container
        })
      }
    })


    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
      xAxis: xAxis
    }));
    cursor.lineY.set("visible", false);

    // Update data every second
    setInterval(function() {
      addData();
    }, 1000)


    function addData() {
      var lastDataItem = series.dataItems[series.dataItems.length - 1];

      var lastValue = lastDataItem.get("valueY");
      // var newValue = value + ((Math.random() < 0.5 ? 1 : -1) * Math.random() * 5);
      var newValue = value + ((Math.random() < 0.5 ? 1 : -1) * Math.random() * 2);
      var lastDate = new Date(lastDataItem.get("valueX"));
      var time = am5.time.add(new Date(lastDate), "second", 1).getTime();
      series.data.removeIndex(0);
      series.data.push({
        date: time,
        value: newValue
      })

      var newDataItem = series.dataItems[series.dataItems.length - 1];
      newDataItem.animate({
        key: "valueYWorking",
        to: newValue,
        from: lastValue,
        duration: 600,
        easing: easing
      });

      // use the bullet of last data item so that a new sprite is not created
      newDataItem.bullets = [];
      newDataItem.bullets[0] = lastDataItem.bullets[0];
      newDataItem.bullets[0].get("sprite").dataItem = newDataItem;
      // reset bullets
      lastDataItem.dataContext.bullet = false;
      lastDataItem.bullets = [];


      var animation = newDataItem.animate({
        key: "locationX",
        to: 0.5,
        from: -0.5,
        duration: 600
      });
      if (animation) {
        var tooltip = xAxis.get("tooltip");
        if (tooltip && !tooltip.isHidden()) {
          animation.events.on("stopped", function() {
            xAxis.updateTooltip();
          })
        }
      }
    }


    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    chart.appear(1000, 100);
    xAxis.hide();
    yAxis.hide();
  }); // end am5.ready()
</script>

<!-- HTML -->

<main id="primary" class="site-main-aboutus">
  <div class="container px-custom">
    <div id="aboutus-banner" class="aboutus-banner main-banner-section">
      <div id="chartdiv"></div>
      <div class="aboutus-banner-text text-center">
        <?php
        $banner_text = get_field('banner_text', get_the_ID());
        $banner_title_line1 = get_field('banner_title_line1', get_the_ID());
        $banner_title_line2 = get_field('banner_title_line2', get_the_ID());
        ?>

        <h1 class="entry-title">
          <span class="main-color-black"><?php echo $banner_title_line1; ?></span><br>
          <?php echo $banner_title_line2; ?>
        </h1>
        <div class="aboutus-banner-desc"><?php echo $banner_text; ?></div>
      </div>

      <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
      </div>

    </div>

    <div class="aboutus-description" data-aos="fade-up">
      <?php
      while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>

    <?php
    // SHOW ACTIVITIES
    if (have_rows('activity')) :
      echo '<div class="aboutus-activity">';
      echo '<div class="row">';
      while (have_rows('activity')) : the_row();
        // Load sub field value.
        $the_title = get_sub_field('about_title');
        $the_icon = get_sub_field('about_icon');
        $the_desc = get_sub_field('about_description');

        echo '
          <div class="col-xl-4">
            <div class="aboutus-activity-item aos-init aos-animate" data-aos="fade-right">
              <div class="aboutus-activity-image"><img src="' . $the_icon['url'] . '" /></div>
              <h3 class="aboutus-activity-title">' . $the_title . '</h3>
              <div class="aboutus-activity-desc">' . $the_desc . '</div>
            </div>
          </div>
          ';
      endwhile;
      echo '</div>';
      echo '</div>';
    endif;
    ?>

    <?php
    // SHOW INTRODUCTION
    if (have_rows('introductions')) :
      echo '<div class="aboutus-introduction text-center text-md-start">';
      echo '<h2 class="widget-title main-color-blue" data-aos="fade-up">활동 소개</h2>';
      while (have_rows('introductions')) : the_row();
        // Load sub field value.
        $introduction_title = get_sub_field('introduction_title');
        $introduction_description = get_sub_field('introduction_description');
        $introduction_link = get_sub_field('introduction_link');

        $introduction_link_html = '';
        if (strlen($introduction_link) > 0) {
          $introduction_link_html = '<p class="aboutus-introduction-link-more text-end text-md-start mt-3"><a href="' . $introduction_link . '" target="_blank">더 알아보기 <i class="bi-chevron-right"></i></a></p>';
        }

        $table_attribute = '';
        if (have_rows('atributes')) :
          $table_attribute = '<div class="table-responsive mt-4 text-23">';
          $table_attribute .= '<table class="table table-borderless">';
          while (have_rows('atributes')) : the_row();
            $attribute_title = get_sub_field('attribute_title');
            $attribute_description = get_sub_field('attribute_description');
            $attribute_link = get_sub_field('attribute_link');

            $table_attribute .= '
            <tr>
              <td><a href="' . $attribute_link . '"><span class="main-color-blue">' . $attribute_title . '</span></a></td>
              <td><a href="' . $attribute_link . '">' . $attribute_description . '</a></td>
              <td><a href="' . $attribute_link . '"><i class="bi-chevron-right"></i></a></td>
            </tr>';
          endwhile;
          $table_attribute .= '</table>';
          $table_attribute .= '</div>';
        endif;

        echo '
        <div class="row mt-5" data-aos="fade-up">
          <div class="col-md-3">
            <h3 class="module-sub-title main-color-black bg-border d-inline-block pb-1 mb-3">' . $introduction_title . '</h3>
          </div>
          <div class="col-md-9">' . $introduction_description . $table_attribute . $introduction_link_html . '</div>
        </div>
        ';
      endwhile;
      echo '</div>';
    endif;
    ?>
  </div><!-- container -->
</main><!-- #main -->

<?php
get_footer();
