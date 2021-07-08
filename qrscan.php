<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
	    <title><?php echo $page_name; ?> | <?php echo SITETITLE; ?></title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700;900&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="css/style.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	    <script src="qrscanner/lib/jsqr/jsQR.js"></script>
		<style>
			#canvas {
			  	width: 100%;
			}
			#loadingMessage {
				margin-top: 20px;
			}
			#output {
				margin-top: 20px;
			}
		</style>	
	</head>
	<body>
		<div class="container">
			<div class="main-container">
				<div id="loadingMessage" class="text-center">
					<h1 class="site-title">GOTCHA!</h1>
			        <br>
					อุปกรณ์ไม่พร้อมใช้งาน กรุณาลองใหม่ หรือเปลี่ยนอุปกรณ์ในการใช้งาน
					<br><br>
					<a href="index.php" class="btn btn-danger">ยกเลิก</a>
				</div>
				<canvas id="canvas" hidden></canvas>
				<div id="output" class="text-center" hidden>
					<div id="outputMessage">
						คุณสามารถสแกนคิวอาร์โค้ดเพื่อเข้าถึงบริการต่างๆ เช่น การเพิ่มบัตรสะสมแต้ม
					</div>
					<br>
					<a href="index.php" class="btn btn-danger">ยกเลิก</a>
				</div>
			</div>
		  	<script>
			    var video = document.createElement("video");
			    var canvasElement = document.getElementById("canvas");
			    var canvas = canvasElement.getContext("2d");
			    var loadingMessage = document.getElementById("loadingMessage");
			    var outputContainer = document.getElementById("output");
			    var outputMessage = document.getElementById("outputMessage");
				var TLR,TRR,BRL,BLL;
				var code;
				var waiting;

			    function drawLine(begin, end, color) {
			      canvas.beginPath();
			      canvas.moveTo(begin.x, begin.y);
			      canvas.lineTo(end.x, end.y);
			      canvas.lineWidth = 4;
			      canvas.strokeStyle = color;
			      canvas.stroke();
				  return true;
			    }

			    // Use facingMode: environment to attemt to get the front camera on phones
			    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
			      video.srcObject = stream;
			      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
			      video.play();
			      requestAnimationFrame(tick);
			    });

			    function tick() {
			      loadingMessage.innerText = "กำลังเปิดกล้อง....."
			      if (video.readyState === video.HAVE_ENOUGH_DATA) {
			        loadingMessage.hidden = true;
			        canvasElement.hidden = false;
			        outputContainer.hidden = false;

			        canvasElement.height = video.videoHeight;
			        canvasElement.width = video.videoWidth;
					canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
					if(!video.paused){				
						var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
						 code = jsQR(imageData.data, imageData.width, imageData.height, {
						  inversionAttempts: "dontInvert",
						});					
					}
			        if (code) {
			          TLR = drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#204F8C");
			          TRR = drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#204F8C");
			          BRL = drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#204F8C");
			          BLL = drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#204F8C");
			          outputMessage.hidden = true;
			          
			          window.location.assign(code.data);
					  
					  if(code.data!="" && !waiting && TLR==true && TRR==true && BRL==true && BLL==true ){
					  	console.log(code.data);
						// สามารถส่งค่า code.data ไปทำงานอย่างอื่นๆ ผ่าน ajax ได้
					  	video.pause();

						// ให้เริ่มเล่นวิดีโอก่อนล็กน้อย เพื่อล้างค่ารูป qrcod ล่าสุด เป็นการใช้รูปจากกล้องแทน
						setTimeout(function(){
							video.play();
						},2500);
						// ให้รอ 5 วินาทีสำหรับการ สแกนในครั้งจ่อไป
						 waiting = setTimeout(function(){
						 	TLR,TRR,BRL,BLL = null;
							if(waiting){
								clearTimeout(waiting);
								waiting = null;					
							}
						  },3000);					
					  }
			        } else {
			          outputMessage.hidden = false;
			        }
			      }
			      requestAnimationFrame(tick);
			    }
		  	</script>
		  </div>
	</body>
</html>