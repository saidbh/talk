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
                        <button type="submit" class="btn btn-secondary btn-block">Post</button>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        <div class="iq-card">
            <div class="iq-card-body">
                <p>
                    <a href="#">
                        Like
                      </a>
                      &nbsp; 
                    <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Comment
                    </a>
                  </p>
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
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
        $(document).ready(function() {
            $('#recordButton').show();
          $('#stopButton').hide();
            });
            URL = window.URL || window.webkitURL;
      var gumStream;
      var rec;
      var input;
      var AudioContext = window.AudioContext || window.webkitAudioContext;
      var audioContext = new AudioContext;
      var recordButton = document.getElementById("recordButton");
      var stopButton = document.getElementById("stopButton");
      var pauseButton = document.getElementById("pauseButton");
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
/*       recordButton.addEventListener("click", startRecording);
      stopButton.addEventListener("click", stopRecording);
      pauseButton.addEventListener("click", pauseRecording);  */
      function startRecording() {
          var constraints = { audio: true, video:false }
          navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
          audioContext = new AudioContext();
      /* 		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"
      */		gumStream = stream;
          input = audioContext.createMediaStreamSource(stream);
          rec = new Recorder(input,{numChannels:1})
          rec.record()
        }).catch(function(err) {
/*             recordButton.disabled = false;
            stopButton.disabled = true;
            pauseButton.disabled = true */
        });
      }

      function pauseRecording() {
          if (rec.recording) {
              rec.stop();
              pauseButton.innerHTML = "Resume";
          } else {
              rec.record()
              pauseButton.innerHTML = "Pause";
          }
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
      /*     link.href = url;
      */    link.download = new Date().toISOString() + '.wav';
      /*     link.innerHTML = link.download;
      */    li.appendChild(au); 
          li.appendChild(link);
          recordingsList.appendChild(li);
      }
    </script>
