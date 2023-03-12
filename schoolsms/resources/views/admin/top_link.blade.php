<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{Session::get('title')}} | </title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('public/public/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('public/public/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('public/public/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('public/public/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('public/public/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('public/public/build/css/custom.min.css')}}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
 
    <link href="{{ URL::asset('public/public/css/global_style.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
      <input type="hidden" name="USER_ID" id="USER_ID" value="{{session(0)->USER_ID}}"/>
      <input type="hidden" name="STAFF_ID" id="STAFF_ID" value="{{session(0)->STAFF_ID}}"/>
      <input type="hidden" name="USER_NAME" id="USER_NAME" value="{{session(0)->USER_NAME}}"/>
      <input type="hidden" name="USER_EMAIL" id="USER_EMAIL" value="{{session(0)->USER_EMAIL}}"/>
      <input type="hidden" name="USER_MOBILE" id="USER_MOBILE" value="{{session(0)->USER_MOBILE}}"/>
      <input type="hidden" name="USER_ROLE" id="USER_ROLE" value="{{session(0)->USER_ROLE}}"/>
       <input type="hidden" name="USER_STATUS" id="USER_STATUS" value="{{session(0)->USER_STATUS}}"/>
      <input type="hidden" name="CREATED_AT" id="CREATED_AT" value="{{session(0)->CREATED_AT}}"/>
      
     