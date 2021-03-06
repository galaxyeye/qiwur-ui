<?php $this->layout = 'empty' ?>

<!DOCTYPE HTML>

<html>

<head>
  <meta charset="utf-8">
  <title>人物关系图</title>

  <link rel="stylesheet" type="text/css" href="/css/people_graph.css" />

  <style>
    .stage { position : relative; }
    .message { position : absolute; left : 5px; top : 80px; min-width : 300px; margin-left:50px; z-index : 100000}
    #graph { float : left; min-height:800px; min-width:1000px; width:100% }
  </style>

</head>

<body>

	<div class='stage'>
		<div class='search_box'>
		  <div class='input'>
		    <input type="text" name="name" id="queryName">
		    <input type="submit" value="搜索" onclick="showGraph();">
		  </div>
		</div>

	    <div class="message"></div>

        <div id="graph"></div>
    </div>

    <!-- 
    <script type="text/javascript" src="/js/jquery/jquery-1.11.2.js" />
     -->
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="/js/echarts/dist/echarts.js"></script>

    <script type="text/javascript">
        var graphUrl = "/common/graph";
        require.config({
          paths: {
            echarts : '/js/echarts/dist'
          }
        });

        function onEchartsReady(ec) {
          // 基于准备好的dom，初始化echarts图表
          var forceChart = ec.init(document.getElementById('graph'));
          forceChart.hideLoading();
          forceChart.setTheme("macarons");

          var option = {
            tooltip : {
            	show: true,
            	// position : [20, 40],
            	position : [-1000, -1000],
            	enterable : true,
            	// formatter: "Template formatter: <br/>{b}<br/>{a}:{c}<br/>{a1}:{c1}",
            	formatter: formatTooltip
        	}, //formatter: "Template formatter: <br/>{b}<br/>{a}:{c}<br/>{a1}:{c1}"
            title : { text : '人物、机构、组织关系图谱' },
			series : [{
		      type : 'force', name : '简介', ribbonType: false,
		      categories : [{name: '人物'}, {name: '机构'}],
		      itemStyle : {normal: {label: {show: true, textStyle: {color: '#333'}},
                 nodeStyle : {brushType : 'both', borderColor : 'rgba(255,215,0,0.4)', borderWidth : 5},
                 linkStyle : {type: 'curve'}},
                 emphasis : {label: {show: false},nodeStyle : {}, linkStyle : {}}
		      },
		      useWorker : false, minRadius : 30, maxRadius : 40, gravity : 1.1, scaling : 1.1, roam: 'move',
			  nodes : ec.graph['nodes'],
			  links : ec.graph['links']
		    }]
          }; // option

          // 为echarts对象加载数据
          forceChart.setOption(option);
        }

        function object2html(obj) {
            var html = '<ul>';

            $.each(obj, function(name, value) {
              html += '<li>';

              if (typeof(value) === 'string') {
                  html += name + " : " + value;
              } else if (typeof(value) === 'object') {
            	  html += object2html(value);
              }

              html += '</li>';
            });
            html += '</ul>';

            return html;
        }

        function formatTooltip(params, ticket, callback) {
          var res = object2html(params["5"]);

          $('.message').html(res);

          // res = 
          callback(ticket, res);

          return res;
        }

        function onGraphDataReady(graph) {
	        require(['echarts','echarts/chart/force'], function (ec) {
	        	ec.graph = graph;
	        	onEchartsReady(ec);
	        });
        } // onGraphDataReady

    	function showGraph() {
        	var q = $('#queryName').val();
    	    $.getJSON(graphUrl + '/' + q + "?t=" + new Date().getTime(), function(graph) {
    	        onGraphDataReady(graph);
    	    });
    	}

        $(document).ready(function() {
        	$('#queryName').val("");
            showGraph();
        });

    </script>

</body>
</html>
