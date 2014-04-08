/*global define */
define([], function () {
    'use strict';

    return '\'Allo \'Allo!';
});

// highchrats 設定
(function($){
    $(function () {
        $('#toolGraph').highcharts({
          colors: ['#2467b1', '#573d7d', '#ffb756', '#f54d27', '#2c99c7', '#000', '#fba919'],
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true
            },
            /* title: {
            }, */
            tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage}%</b>',
              percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#666',
                        connectorColor: '#666',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Tools of work',
                data: [
                    ['Photoshop', 20.0],
                    ['Bootstrap', 20.0],
                    ['Sublime Text', 20.0],
                    ['Git', 15.0],
                    ['Wordpress', 10.0],
                    ['Yeoman', 10.0],
                    ['Grunt', 5.0]
                ]
            }]
        });
    });
})(jQuery);

(function($){
    $(function () {
        $('#skillGraph').highcharts({
          colors: ['#e44d26', '#0473b7', '#b7e39b', '#c6538c', '#ffda3e', '#5967a4', '#2c99c7'],
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true
            },
            /* title: {
            }, */
            tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage}%</b>',
              percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#666',
                        connectorColor: '#666',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Skill set',
                data: [
                    ['HTML5', 20.0],
                    ['CSS3', 20.0],
                    ['Design', 20.0],
                    ['Sass', 17.0],
                    ['JavaScript', 13.0],
                    ['PHP', 5.0],
                    ['Wordpress', 5.0]
                ]
            }]
        });
    });
})(jQuery);

// contact
window.onload = function() {
    new Spry.Widget.ValidationTextField("checkText1", "none", {validateOn:["change"]});
    new Spry.Widget.ValidationTextField("checkText2", "email",{validateOn:["change"]});
    // new Spry.Widget.ValidationTextarea("checkText3",{minChars:10, maxChars:5000,validateOn:["change"]});
}
