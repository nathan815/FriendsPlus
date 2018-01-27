@extends('layouts.two_col_right_sidebar')

@section('title', 'About')

@section('content')

<div class="white-box">
  <h3>About</h3>
  <p>Friends+ enables you to socialize with your friends by posting statuses and pictures, chatting, creating groups, and more. Best of all, it's free to use and free of advertisements. It was built by Nathan Johnson with <a href="http://laravel.com" target="_blank">Laravel</a>, an awesome MVC framework that makes PHP much nicer to code with.</p>
  <h4>Why did I make this?</h4>
  <p>I created Friends+ for my Senior Exit Project showcase. The showcase is a project in which we must spend time doing something in the career we chose and then present what we've done to the class. The career I chose for my Senior Exit Project is software development, thus I built this web application to showcase me doing something in this field. I spent many hours building this &mdash; much more than the required amount of hours! For the job shadow portion of my Senior Exit Project, I had the great oppurtunity to job shadow at <a href="http://spudsoftware.com/" target="_blank">Spud Software</a> in Grand Blanc, MI. It was a great experience and I learned a lot from Spud's awesome team members!
  <h4>Want to contribute?</h4>
  <p>Friends+ is open-source! Check out the GitHub repository and feel free to submit a pull request if you would like to make any improvements. Even if you aren't into coding you can still look at the code behind the scenes if you'd like.</p>
  <a href="http://github.com/nathan815/friendsplus" target="_blank" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-console"></span> Go to GitHub Repo</a>
</div>

@stop

@section('sidebar')

<div class="white-box">
  <img src="/assets/img/nathan.jpg" style="width:100px;margin:0 0 10px 10px" class="pull-right img-rounded" />
  <div>
    <h5>Nathan Johnson</h5>
    <p>Hello, my name is Nathan and I am a senior in high school. Coding has been a hobby of mine since I was 13 years old. Currently, I am captain and head programmer on my school's FIRST Robotics Competition team. After high school, I plan on attending the University of Michigan and majoring in Computer Science in order to eventually become a professional software developer.</p>
  </div>
</div>

<div class="white-box">
  <strong>Have any questions or concerns?</strong> You can <a href="/contact">contact me</a> at any time. I'll do my best to get back in a timely fashion.
</div>
@stop