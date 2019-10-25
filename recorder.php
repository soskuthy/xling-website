<DOCTYPE html>
<html><head>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<script src="/bootstrap/js/bootstrap.min.js"></script>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Audio Recorder</title>

    <div id="dom-target" style="display: none;">
    <?php
        session_start();
        $user_id = $_SESSION["user_id"];
        echo htmlspecialchars($user_id);
        $reading_passage = file_get_contents('language/eng/reading_passage.txt');
    ?>
    </div>
    <script>
        var div = document.getElementById("dom-target");
        var user_id = div.innerText.trim();
    </script>
    
	<script src="js/audiodisplay.js"></script>
	<script src="js/recorderjs/recorder.js"></script>
	<script src="js/main.js"></script>

	<style>
	html { overflow: hidden; }
	body { 
		font: 12pt Arial, sans-serif; 
		background: lightgrey;
		// display: flex;
		// flex-direction: column;
		height: 100vh;
		width: 100%;
		margin: 0 0;
	}
	canvas { 
		display: inline-block; 
		background: #202020; 
		width: 90%;
		height: 45%;
		box-shadow: 0px 0px 10px blue;
	}
	#controls {
		display: flex;
		flex-direction: column;
		height: 15%;
		width: 100%;
		min-height: 160px;
	}
	#buttons {
		display: flex;
		flex-direction: row;
                text-align: center;
		align-items: center;
		padding: 10px 0px;
		width: 100%;
		justify-content: space-around;
	}
	#progresstext {
		padding: 10px 0px;
		text-align: center;
		margins: auto;
	}
	#record, #exit, #save img { max-height: 70px; height: 10vh; width: auto;}
	// #exit { height: 70px; }
	// #save, #save img { height: 70px; }
	#record.recording { 
		background: red;
		background: -webkit-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: -moz-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
	}



.column-container {display: flex; width: 100%; height: 100%; flex-direction: row;}
.second-column { display:flex; flex-direction: column; width: 30%; min-width: 300px; overflow: auto; }
.first-column { flex: 1 1; border: none; margin: 0; padding: 0; overflow: auto; -webkit-overflow-scrolling:touch; }
.first-column iframe {width: 100%; height: 100%; border: none; margin: 0; padding: 0; display: block;}

	// #save, #save img { height: 10vh; }

	#save { opacity: 0.25;}
	#save[download] { opacity: 1;}
	#viz {
		height: 85%;
		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;
	}
	@media (orientation: portrait) {
		.column-container { flex-direction: column;}
		.second-column { width: 100%; height: 40%; }
		#viz { height: 150px; }
		#record, #exit, #save img { height: 10vw;}
		#controls { font-size: 3vw; } 
		// #controls { flex-direction: column; height: 100%; width: 100%;}
		// #viz { height: 100%; width: 100%;}
	}
object{  width: 100%;  height: 60%; font-family: arial, sans-serif;}
table {  font-family: arial, sans-serif;  border-collapse: collapse;  width: 100%;}


@supports (-webkit-overflow-scrolling: touch) {
  .first-column { width: 50%; }
  .second-column { width: 50%; }
}


	</style>
</head>
<body>
	<nav class="navbar navbar-primary bg-primary">
        <span class="navbar-brand mb-0 h1">Recorder Tool</span>
    </nav>
	<div class="column-container">
	<div class="first-column">
		<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Instructions
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        You can see the recording pane on the right-hand side. The top Recording window shows the level of the incoming sound. The bottom Recording window will show the recorded waveform when it is complete. Underneath the two windows are a Playback Control, a Microphone icon, and a Submit icon (an arrow going into a hard drive). To record the story, click on the Microphone icon (which will glow red), read the passage aloud, and then click on the Microphone icon again to stop recording. The lower window will then show your recording as a waveform. Clicking on the Play button in the Playback Control will allow you to hear your recording. If you are satisfied with it, you can click on the Submit button and your recording will be sent to the University of British Columbia. Once you have submitted your recording, you canclick on Close Recording Pane to make the Recording Pane go away.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Reading Sample: The Benefits of Hiking
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <?php echo $reading_passage ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          SPontaneous Speech Prompts
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
	</div>

	<div class="second-column">
	<div id="viz">
		<canvas id="analyser" width="1000" height="150"></canvas>
		<canvas id="wavedisplay" width="1000" height="150"></canvas>
                <audio id="recorded-audio" controls="controls"></audio>
	</div>
	<div id="controls">
		<div id="buttons">
		<div id="record-div"><a href="#" title="Click to start or stop recording" onclick="toggleRecording(document.getElementById('record'));"><img id="record" src="images/mic128.png" width="70" height="70"><br/><div id="rectext">Start/Stop Recording</div></a></div>
		<div id="save-div"><a id="save" href="#" onclick="startSubmit(this);"><img src="images/save.svg" width="70" height="70"><br/>Submit Recording</a></div>
		<div id="exit-div"><a href="#" onclick="window.location = document.getElementById('iframe').src;"><img id="exit" width="70" height="70" src="images/exit.png"><br/>Close Recorder</a></div>
		</div>
		<div id="progresstext"><div style="color: red;">Recording not yet submitted</div><table>
			<tr>
				<th></th><th>Status:</th>
			</tr>
			<tr>
				<th>Reading passage</th><th>Not submitted</th>
			</tr>
			<tr>
				<th>Spontaneous speech</th><th>Not submitted</th>
			</tr>
		</table></div>
	</div>
	</div>
	</div>
</body></html>
