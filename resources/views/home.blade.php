@extends('layouts.app')

@section('content')
<div class="container">


  <!-- quill does not include dist files! We are using the hosted version instead -->
  <!--link rel="stylesheet" href="/bower_components/quill/dist/quill.snow.css" /-->
  <link href="https://cdn.quilljs.com/1.0.4/quill.snow.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.5.1/katex.min.css" rel="stylesheet"> 
  <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/monokai-sublime.min.css" rel="stylesheet">
  <style>
    #quill-container {
      border: 1px solid gray;
      box-shadow: 0px 0px 10px gray;
    }
  </style>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.5.1/katex.min.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js" type="text/javascript"></script>
  <script src="https://cdn.quilljs.com/1.0.4/quill.js"></script>
  <!-- quill does not include dist files! We are using the hosted version instead (see above)
  <script src="/bower_components/quill/dist/quill.js"></script>
  -->
  <script src="/bower_components/yjs/y.es6"></script>
  <script src="/bower_components/yjs/Examples/Quill/index.js"></script>



  <div id="quill-container">
    <div id="quill">
    </div>
  </div>
<div id="log">
</div>
      
</div>
@endsection
