    <div class="container-fluid">
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                          <div id="controls">
                            <button id="recordButton" class="btn btn-success btn-block"><i class="ri-mic-2-fill"></i></button>
                            <button id="stopButton" class="btn btn-success btn-block" >Stop</button>
                           </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                             <div id="formats" class="btn-block"></div>
                             <ol id="recordingsList" style="width: 100%;">
                             </ol>
                        </div>
                    </div>
                </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <button type="submit" id="submitPost" class="btn btn-secondary btn-block">Post</button>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <audio style="width: 100%" controls>
                    <source src="" type="audio/ogg">
                  </audio>
                <p>
                    <a href="#">
                        Like
                      </a>
                      &nbsp; 
                    <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Comment
                    </a> &nbsp;   
                    <a href="#">
                        Report
                      </a>
                  </p>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        --
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <style>
      li {
          list-style-type: none;
      }
    </style>
    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
    <script>
        $(document).ready(function(){
          $('#recordButton').show();
          $('#stopButton').hide();
          URL = window.URL || window.webkitURL;
          var gumStream;
          var rec;
          var input;
          var AudioContext = window.AudioContext || window.webkitAudioContext;
          var audioContext = new AudioContext;
          $('#recordButton').on('click', function(){
          $('#recordButton').hide();
          $('#stopButton').show();
          startRecording();
          });
          $('#stopButton').on('click', function(){
              $('#recordButton').show();
              $('#stopButton').hide();
              stopRecording();
          });
          function startRecording() {
          var constraints = { audio: true, video:false }
          navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
          audioContext = new AudioContext();
      		gumStream = stream;
          input = audioContext.createMediaStreamSource(stream);
          rec = new Recorder(input,{numChannels:1})
          rec.record()
        }).catch(function(err) {
          console.log(err);
        });
      }
      function stopRecording() {
          rec.stop(); 
          gumStream.getAudioTracks()[0].stop();
          rec.exportWAV(createDownloadLink);
      }
      function createDownloadLink(blob) {
          var url = URL.createObjectURL(blob);
          var au = document.createElement('audio');
          var li = document.createElement('li');
          var link = document.createElement('a');
          au.controls = true;
          au.src = url;
          au.style = "width:100%";
          au.id = "vocalPost"
          link.download = new Date().toISOString() + '.wav';
      /*  link.innerHTML = link.download;*/
           li.appendChild(au); 
          li.appendChild(link);
          recordingsList.appendChild(li);
      }
      $('#submitPost').on('click', function(){
        let vocal = $('#vocalPost').attr('src');
        console.log(vocal);
        $.ajax({
        "headers": {
          'X-CSRF-TOKEN': '{{csrf_token()}}',
        },
        "url": "{{ route('users-newsFeed.store') }}",
        "type": "post",
        "responseType": 'json',
        "data":{

        },
        success: function (data) {
          getUpdateNewsFeed();
        }
      });
            });
            function getUpdateNewsFeed()
            {
              $.ajax({
              "headers": {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
              },
              "url": "{{ route('users-newsFeed.list') }}",
              "type": "post",
              "responseType": 'json',
              "data":{

              },
              success: function (data) {

              }
            });
            }
        });













    </script>