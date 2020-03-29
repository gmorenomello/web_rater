<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            .slidecontainer {
              width: 50%;
            }
            
            .slider {
              -webkit-appearance: none;
              width: 100%;
              height: 25px;
              background: #d3d3d3;
              outline: none;
              opacity: 0.7;
              -webkit-transition: .2s;
              transition: opacity .2s;
            }
            
            .slider:hover {
              opacity: 1;
            }
            
            .slider::-webkit-slider-thumb {
              -webkit-appearance: none;
              appearance: none;
              width: 25px;
              height: 25px;
              background: #4CAF50;
              cursor: pointer;
            }
            
            .slider::-moz-range-thumb {
              width: 25px;
              height: 25px;
              background: #4CAF50;
              cursor: pointer;
            }
        </style>
        <script type="text/javascript" >
            var files = <?php $out = array();
            foreach (glob('usr/*.jpg') as $filename) {
                $p = pathinfo($filename);
                $out[] = $p['filename'];
            }
            echo json_encode($out); ?>;
        </script>
        
    </head>
    <body>
        
        <script>
            var n_of_imgs = files.length;
            let current_imag = 1;
            var foto_results = [];

            function get_image_name(img_idx, files_array){
                var f_name = 'usr/'+files_array[img_idx] +'.jpg';
                return f_name;
            }

            function submit_answers(){
                document.getElementById("status").innerHTML = foto_results;
                var value = document.getElementById("status").innerHTML;
                document.getElementById("all_answers").value = foto_results;
                if (foto_results.length != 0) {
                    document.getElementById("answer_form").submit();
                    alert('We sent your answers, Thank you.');
                    /*
                    $.post("submit.php", {
                        variable:value
                    }, function(data) {
                        if (data != "") {
                            alert('We sent Jquery string to PHP : ' + data);
                        }
                    }); */
                }
            }
            function add_to_list(){
                var sep = "-";
                var end_sep = ";";
                var answer =  get_image_name(current_imag,files) + sep + document.getElementById("confRange").value  + sep + document.getElementById("trustRange").value + sep + document.getElementById("warmthRange").value;
                window.foto_results.push(answer);
            }

            function update_image(){
                //window.current_image++;
                //nxt_frame = get_image_name(current_image, files);
                // <button type="button" onclick="document.getElementById('img').src=get_image_name(current_imag,files)">Click here</button>
                //
                add_to_list();
                if(current_imag < files.length-1){
                    window.current_imag = current_imag++;
                }
                window.document.getElementById('status').innerHTML = get_image_name(current_imag,files);
                window.document.getElementById('img').src=get_image_name(current_imag,files);

                document.getElementById("confRange").value = 50;
                document.getElementById("trustRange").value = 50;
                document.getElementById("warmthRange").value = 50;
                document.getElementById("confid").innerHTML = 50;
                document.getElementById("trust").innerHTML = 50;
                document.getElementById("warmth").innerHTML = 50;
            }
        </script>

        <div>
            <img id="img" src="./usr/foto_00001.jpg" style="width:500px">
        </div>
        
        <div class="slider_confidence">
            Does this person looks self-confident? (from 0-100)
            <table style="width:500px">
                <tr>
                  <th><input type="range" min="1" max="100" value="50" class="slider" id="confRange"></th>
                  <th style="width:50px"><p id="confid">50</p></th>
                </tr>
            </table>
        </div>
        <div class="slider_trust">
            Would you trust this person? (from 0-100)
            <table style="width:500px">
                <tr>
                  <th><input type="range" min="1" max="100" value="50" class="slider" id="trustRange"></th>
                  <th style="width:50px"><p id="trust">50</p></th>
                </tr>
            </table>
            
        </div>

        <div class="slider_warmth">
            How friendly and approacheable this person looks? (from 0-100)
            <table style="width:500px">
                <tr>
                  <th><input type="range" min="1" max="100" value="50" class="slider" id="warmthRange"></th>
                  <th style="width:50px"><p id="warmth">50</p></th>
                </tr>
            </table>
        </div>
        <div class="buttons">
            <button type="button" onclick="window.update_image()">click here to answer</button>
            <button type="button" onclick="window.submit_answers()">submit your answers</button>
           
        </div>
        </div>
            <p id="status"></p>
            <form id="answer_form" action="submit.php" method="POST">
                 <input type="hidden" id ="all_answers" name="all_answers"><br>
                <!--<input type="button" onclick="myFunction()" value="Submit form"-->
              </form>
              
        <div >
        <script>
            var conf_slider = document.getElementById("confRange");
            var conf_output = document.getElementById("confid");
            conf_output.innerHTML = conf_slider.value;
            
            conf_slider.oninput = function() {
              conf_output.innerHTML = this.value;
            }

            var trust_slider = document.getElementById("trustRange");
            var trust_output = document.getElementById("trust");
            trust_output.innerHTML = trust_slider.value;
            
            trust_slider.oninput = function() {
              trust_output.innerHTML = this.value;
            }

            var warmth_slider = document.getElementById("warmthRange");
            var warmth_output = document.getElementById("warmth");
            warmth_output.innerHTML = warmth_slider.value;
            
            warmth_slider.oninput = function() {
                warmth_output.innerHTML = this.value;
            }
        </script>
        
    </body>
</html>