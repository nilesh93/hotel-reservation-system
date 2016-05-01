(function(){

 'use strict';
 angular.module('dashboard',['ui.calendar'])

  .config(function($interpolateProvider){
  $interpolateProvider.startSymbol('{{{').endSymbol('}}}');
 })
  .controller('DashboardController',function($scope,$http,$rootScope,$log ){

  //$scope.room = {};

  $scope.eventSources = {
   events: function(start, end, timezone, callback) {



    $http.get("getEvents").then(function(data){

     var events  = [];

     data.data.forEach(function(item,index){

      events.push({
       title:item.room_type + "-" + item.num_of_rooms+" room(s)",
       start:item.check_in.replace(' ','T'),
       end: item.check_out.replace(' ','T'),
       color: 'yellow',   // an option!
       textColor: 'black',
       eventInfo:{

        id: item.room_reservation_id,
        remarks: item.remarks,
        adults:item.adults,
        kids:item.children,
        rooms:item.num_of_rooms,
        type:item.room_type,
        status  :item.status,
        customer: item.name,
        nic:item.NIC_passport_num,
        phone:item.telephone_num,
        checkin:item.check_in,
        checkout:item.check_out
       }
      });

     });


     callback(events);

    }); 
   }
   // an option!
  };


  /*
  function eventGenerate(start,end,timezone,callack){

   $http.get("getEvents").then(function(data){

    //console.log("done");
    //
    //console.log(data.data);


    var events  = [];

    events.push({

     title:data.data.room_type + "-" + data.data.num_of_rooms,
     start: data.data.check_in.replace(' ','T'),
     end: data.data.check_out.replace(' ','T')
    });

    callback(events);

   });

  }

*/




  $scope.alertEventOnClick = function(event){

   console.log(event);
   $('#info').modal('show');
   
   $scope.eventI = event.eventInfo;

  }

  $scope.uiConfig = {
   calendar:{
    height: 500,
    editable: true,
    header:{
     left: 'month agendaWeek agendaDay',
     center: 'title',
     right: 'today prev,next'
    },

    selectable :false,

    eventDrop: $scope.alertOnDrop,
    eventResize: $scope.alertOnResize,
    eventClick:$scope.alertEventOnClick
   }
  };




 });




})();
