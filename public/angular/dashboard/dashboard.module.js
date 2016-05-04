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
       title:item.num_of_rooms+" room(s)",
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
        checkout:item.check_out,
        eventType:"rooms"
       }
      });

     });


     callback(events);

    }); 
   }
   // an option!
  };

  $scope.eventSources2 = {
   events: function(start, end, timezone, callback) {



    $http.get("getHallEvents").then(function(data){

     var events  = [];

     data.data.forEach(function(item,index){

      events.push({
       title:item.title,
       start:item.reserve_date.replace(' ','T'),
       end: item.reserve_date.replace(' ','T'),
       color: 'blue',   // an option!
       textColor: 'white',
       eventInfo:{
        id: item.hall_reservation_id
       }
      });

     });


     callback(events);

    }); 
   }
   // an option!
  };


 



  $scope.alertEventOnClick = function(event){

   console.log(event);
   
   $http.get("admin_search_bookings_get?id="+event.eventInfo.id).success(function(data){
    
    document.getElementById('reserveInfo').innerHTML = data;
     
    
   });
   $('#info').modal('show');
   
   $scope.eventI = event.eventInfo;

  }

  
  $scope.alertEventOnClick2 = function(event){

   console.log(event);
   
   $http.get("getHallEventInfo?id="+event.eventInfo.id).success(function(data){
    
    document.getElementById('reserveInfo').innerHTML = data;
     
    
   });
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
  
   $scope.uiConfig2 = {
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
    eventClick:$scope.alertEventOnClick2
   }
  };





 });




})();
