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
<main id="primary" class="single-content-page container px-6 mx-auto md:px-0 md:max-w-2xl xl:container">
  <div class="relative min-h-[124px] md:min-h-[270px] xl:min-h-[415px] bg-aboutus bg-left-bottom bg-no-repeat bg-contain">
    <div id="chartdiv" class="h-full"></div>
    <div class="aboutus-banner-text text-center">
      <?php
      $banner_text = get_field('banner_text', get_the_ID());
      $banner_title_line1 = get_field('banner_title_line1', get_the_ID());
      $banner_title_line2 = get_field('banner_title_line2', get_the_ID());
      ?>

      <h1 class="text-22 md:text-28 xl:text-60">
        <span class="text-black font-light"><?php echo $banner_title_line1; ?></span><br>
        <span class="text-blue-0f font-bold"><?php echo $banner_title_line2; ?></span>
      </h1>
      <div class="text-gray-4c text-13 md:text-14 xl:text-27 mt-24 md:mt-32 xl:mt-[36px]"><?php echo $banner_text; ?></div>
    </div>

    <div class="bubbles">
      <div class="bubble w-10 h-10 left-1"></div>
      <div class="bubble w-5 h-5 left-2"></div>
      <div class="bubble w-11 h-11 left-3"></div>
      <div class="bubble w-[50px] h-[50px] md:w-[70px] md:h-[70px] left-2"></div>
      <div class="bubble w-[30px] h-[30px] md:w-[50px] md:h-[50px] left-1"></div>
      <div class="bubble w-[50px] h-[50px] left-1"></div>
      <div class="bubble w-[45px] h-[45px] left-3"></div>
      <div class="bubble w-[25px] h-[25px] left-2"></div>
      <div class="bubble w-[20px] h-[20px] left-1"></div>
      <div class="bubble w-[30px] h-[30px] left-2"></div>

      <div class="bubble w-[40px] h-[40px] right-[200px]"></div>
      <div class="bubble w-[20px] h-[20px] right-[190px]"></div>
      <div class="bubble w-[40px] h-[40px] md:w-[50px] md:h-[50px] right-[180px]"></div>
      <div class="bubble w-[35px] h-[35px] md:w-[80px] md:h-[80px] right-[170px]"></div>
      <div class="bubble w-[30px] h-[30px] right-[100px]"></div>
      <div class="bubble w-[45px] h-[45px] right-[120px]"></div>
      <div class="bubble w-[40px] h-[40px] md:w-[70px] md:h-[70px] right-[130px]"></div>
      <div class="bubble w-[25px] h-[25px] right-[140px]"></div>
      <div class="bubble w-[20px] h-[20px] right-[150px]"></div>
      <div class="bubble w-[45px] h-[45px] right-[160px]"></div>
    </div>
  </div>

  <div class="mt-[84px] md:mt-[146px] xl:mt-[178px]" data-aos="fade-up">
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
    echo '<div class="grid gap-y-[55px] md:gap-x-[50px] xl:gap-x-[140px] mt-40 md:mt-[55px] xl:mt-[66px] md:grid-cols-3">';
    while (have_rows('activity')) : the_row();
      // Load sub field value.
      $the_title = get_sub_field('about_title');
      $the_icon = get_sub_field('about_icon');
      $the_desc = get_sub_field('about_description');

      echo '
      <div class="text-center text-gray-41" data-aos="fade-right">
        <div class="flex justify-center"><img class="h-[120px] md:h-[84px] xl:h-[130px]" src="' . $the_icon['url'] . '" /></div>
        <h3 class="text-15 xl:text-25 font-medium mt-20 ">' . $the_title . '</h3>
        <div class="text-12 xl:text-17 mt-2 xl:mt-[15px]">' . $the_desc . '</div>
      </div>
      ';
    endwhile;
    echo '</div>';
  endif;
  ?>

  <?php
  // SHOW INTRODUCTION
  if (have_rows('introductions')) :
    echo '<div class="mt-[84px] md:mt-[94px] xl:mt-[106px]">';
    echo '<h2 class="text-22 xl:text-60 text-blue-0f font-medium text-center xl:text-left" data-aos="fade-up">활동 소개</h2>';
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
        $table_attribute .= '<div class="max-w-[320px] md:max-w-none mx-auto mt-20 xl:mt-50">';
        while (have_rows('atributes')) : the_row();
          $attribute_title = get_sub_field('attribute_title');
          $attribute_description = get_sub_field('attribute_description');
          $attribute_link = get_sub_field('attribute_link');

          $table_attribute .= '<div class="flex mt-2 md:mt-4 xl:mt-32 gap-x-[17px] xl:gap-x-[35px] text-left">';
          $table_attribute .= '
            <div class="flex items-center text-11 md:text-14 xl:text-22 2xl:text-25 xl:font-medium text-blue-0f"><a href="' . $attribute_link . '"><span class="main-color-blue">' . $attribute_title . '</span></a></div>
            <div class="flex grow items-center text-11 md:text-13 xl:text-20 2xl:text-23 text-gray-4c"><a href="' . $attribute_link . '">' . $attribute_description . '</a></div>
            <div class="flex items-center md:text-13 xl:text-22 2xl:text-25"><a href="' . $attribute_link . '"><i class="bi-chevron-right"></i></a></div>
          ';
          $table_attribute .= '</div>';
        endwhile;
        $table_attribute .= '</div>';
      endif;

      echo '
        <div class="grid text-center md:text-left md:grid-cols-12 md:mt-[45px] xl:mt-70" data-aos="fade-up">
          <div class="md:col-span-2 xl:col-span-3 2xl:col-span-2">
            <h3 class="bg-border inline-block mt-[45px] md:mt-0 text-24 md:text-18 xl:text-[50px] text-gray-41">' . $introduction_title . '</h3>
          </div>
          <div class="mt-[16px] md:mt-0 md:col-span-9 xl:col-span-8 2xl:col-span-9 md:col-end-13 text-13 md:text-15 xl:text-27 text-gray-4c">' . $introduction_description . $table_attribute . $introduction_link_html . '</div>
        </div>
        ';
    endwhile;
    echo '</div>';
  endif;
  ?>
</main><!-- #main -->

<?php
get_footer();
