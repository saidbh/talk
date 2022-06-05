    <div class="container-fluid">
        <div class="iq-card">
            <div class="iq-card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                             <div id="formats"></div>
                             <ol id="recordingsList"></ol>
                        </div>
                    </div>
                </div>
                  <div class="container text-right">
                      <div class="row">
                          <div class="col-sm-12">
                            <div id="controls">
                              <button id="recordButton" class="btn btn-success rounded-circle"><i class="ri-mic-2-fill"></i></button>
                              <button id="pauseButton" class="btn btn-success rounded-circle" disabled>Pause</button>
                              <button id="stopButton" class="btn btn-success rounded-circle" disabled>Stop</button>
                             </div>
                            <button type="submit" class="btn btn-success">Post</button>
                          </div>
                      </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                      </div>
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
            URL = window.URL || window.webkitURL;
      var gumStream;
      var rec;
      var input;
      var AudioContext = window.AudioContext || window.webkitAudioContext;
      var audioContext = new AudioContext;
      var recordButton = document.getElementById("recordButton");
      var stopButton = document.getElementById("stopButton");
      var pauseButton = document.getElementById("pauseButton");
      recordButton.addEventListener("click", startRecording);
      stopButton.addEventListener("click", stopRecording);
      pauseButton.addEventListener("click", pauseRecording);
      function startRecording() {
          var constraints = { audio: true, video:false }
        recordButton.disabled = true;
        stopButton.disabled = false;
        pauseButton.disabled = false
        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
          audioContext = new AudioContext();
      /* 		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"
      */		gumStream = stream;
          input = audioContext.createMediaStreamSource(stream);
          rec = new Recorder(input,{numChannels:1})
          rec.record()
        }).catch(function(err) {
            recordButton.disabled = false;
            stopButton.disabled = true;
            pauseButton.disabled = true
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
          stopButton.disabled = true;
          recordButton.disabled = false;
          pauseButton.disabled = true;
          pauseButton.innerHTML = "Pause";
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
      /*     link.href = url;
      */    link.download = new Date().toISOString() + '.wav';
      /*     link.innerHTML = link.download;
      */    li.appendChild(au); 
          li.appendChild(link);
          recordingsList.appendChild(li);
      }
    </script>
