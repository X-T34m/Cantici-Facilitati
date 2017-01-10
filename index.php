<html>
<head>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"
			integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			crossorigin="anonymous"></script>
	<script src="preload.js"></script>
	<style>
		* {
			padding: 0;
			margin: 0 auto;
			text-align: center;
		}

		#wait {
			background: #000;
			height: 100%;
		}
	</style>
</head>
<body>
<div id="list" style="">

</div>
<p id="wait" style="display: none;">&blank;</p>
<div id="controls" style="display: none;">
	<p onclick="playNext()"
	   style="height: 70%;background: #fff;">
	</p>
	<p onclick="goBack()"
	   style="height: 30%;background: #000;">
	</p>
	<!--<p onclick="stop()"
	   style="height: 10%;background: #1800ff;">
	</p>-->
</div>
<script>

    (function () {

        $.ajax({
            type: "POST",
            url: "getCantici.php",
            data: {},
            dataType: 'text',

            success: function (response) {

                //alert(response);
                var json;
                try {
                    json = JSON.parse(response);
                }
                catch (e) {
                    return;
                }

                $(".delete").remove();

                for (var i = 0; i < json.length; i++) {
                    var order = json[i];
                    var list = document.getElementById("list");
                    var p = document.createElement("p");
                    p.setAttribute("class", "delete");
                    p.setAttribute("onclick", "pippo('" + order + "')");
                    p.setAttribute("style", "background-color: #fff;width: 100%;font-size: 550px;");
                    p.appendChild(document.createTextNode(order));
                    list.appendChild(p);
                }
            }
        });

        setTimeout(arguments.callee, 300000);
    })();

    Array.prototype.contains = function (obj) {
        var i = this.length;
        while (i--) {
            if (this[i] === obj) {
                return true;
            }
        }
        return false;
    };

    var queue;
    var cantico = -1;
    var currentMP3 = -1;
    var loaded = [];
    var path = "/ale/files/";

    var cantici = [];
    //var endBeep = path + "/end.mp3";
    cantici[10] = [
        {id: 0, c: -1, src: path + "10/1.mp3"},
        {id: 1, c: -1, src: path + "10/2.mp3"},
        {id: 2, c: -1, src: path + "10/3.mp3"},
        {id: 3, c: -1, src: path + "10/4.mp3"},
        {id: 4, c: -1, src: path + "10/c1.mp3"},
        {id: 5, c: -1, src: path + "10/5.mp3"},
        {id: 6, c: -1, src: path + "10/6.mp3"},
        {id: 7, c: -1, src: path + "10/7.mp3"},
        {id: 8, c: -1, src: path + "10/8.mp3"},
        {id: 9, c: 4, src: path + "10/c1.mp3"},
        {id: 10, c: -1, src: path + "10/9.mp3"},
        {id: 11, c: -1, src: path + "10/10.mp3"},
        {id: 12, c: -1, src: path + "10/11.mp3"},
        {id: 13, c: -1, src: path + "10/12.mp3"},
        {id: 14, c: 4, src: path + "10/c1.mp3"},
        {id: 15, c: -1, src: path + "10/end.mp3"}
    ];
    cantici[24] = [
        {id: 0, c: -1, src: path + "24/1.mp3"},
        {id: 1, c: -1, src: path + "24/2.mp3"},
        {id: 2, c: -1, src: path + "24/3.mp3"},
        {id: 3, c: -1, src: path + "24/4.mp3"},
        {id: 4, c: -1, src: path + "24/5.mp3"},
        {id: 5, c: -1, src: path + "24/6.mp3"},
        {id: 6, c: -1, src: path + "24/7.mp3"},
        {id: 7, c: -1, src: path + "24/8.mp3"},
        {id: 8, c: -1, src: path + "24/9.mp3"},
        {id: 9, c: -1, src: path + "24/10.mp3"},
        {id: 10, c: -1, src: path + "24/11.mp3"},
        {id: 11, c: -1, src: path + "24/12.mp3"},
        {id: 12, c: -1, src: path + "24/end.mp3"}
    ];
    cantici[34] = [
        {id: 0, c: -1, src: path + "34/1.mp3"},
        {id: 1, c: -1, src: path + "34/2.mp3"},
        {id: 2, c: -1, src: path + "34/3.mp3"},
        {id: 3, c: -1, src: path + "34/c1.mp3"},
        {id: 4, c: -1, src: path + "34/4.mp3"},
        {id: 5, c: -1, src: path + "34/5.mp3"},
        {id: 6, c: -1, src: path + "34/6.mp3"},
        {id: 7, c: 3, src: path + "34/c1.mp3"},
        {id: 8, c: -1, src: path + "34/end.mp3"}
    ];
    cantici[40] = [
        {id: 0, c: -1, src: path + "40/1.mp3"},
        {id: 1, c: -1, src: path + "40/2.mp3"},
        {id: 2, c: -1, src: path + "40/c1.mp3"},
        {id: 3, c: -1, src: path + "40/c2.mp3"},
        {id: 4, c: -1, src: path + "40/3.mp3"},
        {id: 5, c: -1, src: path + "40/4.mp3"},
        {id: 6, c: 2, src: path + "40/c1.mp3"},
        {id: 7, c: 3, src: path + "40/c2.mp3"},
        {id: 8, c: -1, src: path + "40/5.mp3"},
        {id: 9, c: -1, src: path + "40/6.mp3"},
        {id: 10, c: 2, src: path + "40/c1.mp3"},
        {id: 11, c: 3, src: path + "40/c2.mp3"},
        {id: 12, c: -1, src: path + "40/end.mp3"}
    ];
    cantici[44] = [
        {id: 0, c: -1, src: path + "44/1.mp3"},
        {id: 1, c: -1, src: path + "44/2.mp3"},
        {id: 2, c: -1, src: path + "44/3.mp3"},
        {id: 3, c: -1, src: path + "44/4.mp3"},
        {id: 4, c: -1, src: path + "44/5.mp3"},
        {id: 5, c: -1, src: path + "44/6.mp3"},
        {id: 6, c: -1, src: path + "44/7.mp3"},
        {id: 7, c: -1, src: path + "44/8.mp3"},
        {id: 8, c: -1, src: path + "44/end.mp3"}
    ];
    cantici[45] = [
        {id: 0, c: -1, src: path + "45/1.mp3"},
        {id: 1, c: -1, src: path + "45/2.mp3"},
        {id: 2, c: -1, src: path + "45/3.mp3"},
        {id: 3, c: -1, src: path + "45/4.mp3"},
        {id: 4, c: -1, src: path + "45/5.mp3"},
        {id: 5, c: -1, src: path + "45/6.mp3"},
        {id: 6, c: -1, src: path + "45/7.mp3"},
        {id: 7, c: -1, src: path + "45/8.mp3"},
        {id: 8, c: -1, src: path + "45/9.mp3"},
        {id: 9, c: -1, src: path + "45/10.mp3"},
        {id: 10, c: -1, src: path + "45/11.mp3"},
        {id: 11, c: -1, src: path + "45/12.mp3"},
        {id: 12, c: -1, src: path + "45/end.mp3"}
    ];
    cantici[79] = [
        {id: 0, c: -1, src: path + "79/1.mp3"},
        {id: 1, c: -1, src: path + "79/2.mp3"},
        {id: 2, c: -1, src: path + "79/3.mp3"},
        {id: 3, c: -1, src: path + "79/4.mp3"},
        {id: 4, c: -1, src: path + "79/5.mp3"},
        {id: 5, c: -1, src: path + "79/6.mp3"},
        {id: 6, c: -1, src: path + "79/end.mp3"}
    ];
    cantici[81] = [
        {id: 0, c: -1, src: path + "81/1.mp3"},
        {id: 1, c: -1, src: path + "81/2.mp3"},
        {id: 2, c: -1, src: path + "81/c1.mp3"},
        {id: 3, c: -1, src: path + "81/c2.mp3"},
        {id: 4, c: -1, src: path + "81/3.mp3"},
        {id: 5, c: -1, src: path + "81/4.mp3"},
        {id: 6, c: 2, src: path + "81/c1.mp3"},
        {id: 7, c: 3, src: path + "81/c2.mp3"},
        {id: 8, c: -1, src: path + "81/end.mp3"}
    ];
    cantici[88] = [
        {id: 0, c: -1, src: path + "88/1.mp3"},
        {id: 1, c: -1, src: path + "88/2.mp3"},
        {id: 2, c: -1, src: path + "88/3.mp3"},
        {id: 3, c: -1, src: path + "88/4.mp3"},
        {id: 4, c: -1, src: path + "88/5.mp3"},
        {id: 5, c: -1, src: path + "88/6.mp3"},
        {id: 6, c: -1, src: path + "88/7.mp3"},
        {id: 7, c: -1, src: path + "88/c1.mp3"},
        {id: 8, c: -1, src: path + "88/c2.mp3"},
        {id: 9, c: -1, src: path + "88/c3.mp3"},
        {id: 10, c: -1, src: path + "88/c4.mp3"},
        {id: 11, c: -1, src: path + "88/8.mp3"},
        {id: 12, c: -1, src: path + "88/9.mp3"},
        {id: 13, c: -1, src: path + "88/10.mp3"},
        {id: 14, c: -1, src: path + "88/11.mp3"},
        {id: 15, c: -1, src: path + "88/12.mp3"},
        {id: 16, c: -1, src: path + "88/13.mp3"},
        {id: 17, c: -1, src: path + "88/14.mp3"},
        {id: 18, c: -1, src: path + "88/15.mp3"},
        {id: 19, c: 7, src: path + "88/c1.mp3"},
        {id: 20, c: 8, src: path + "88/c2.mp3"},
        {id: 21, c: 9, src: path + "88/c3.mp3"},
        {id: 22, c: 10, src: path + "88/c4.mp3"},
        {id: 23, c: -1, src: path + "88/end.mp3"}
    ];
    cantici[105] = [
        {id: 0, c: -1, src: path + "105/1.mp3"},
        {id: 1, c: -1, src: path + "105/2.mp3"},
        {id: 2, c: -1, src: path + "105/3.mp3"},
        {id: 3, c: -1, src: path + "105/4.mp3"},
        {id: 4, c: -1, src: path + "105/5.mp3"},
        {id: 5, c: -1, src: path + "105/6.mp3"},
        {id: 6, c: -1, src: path + "105/end.mp3"}
    ];
    cantici[106] = [
        {id: 0, c: -1, src: path + "106/1.mp3"},
        {id: 1, c: -1, src: path + "106/2.mp3"},
        {id: 2, c: -1, src: path + "106/3.mp3"},
        {id: 3, c: -1, src: path + "106/4.mp3"},
        {id: 4, c: -1, src: path + "106/5.mp3"},
        {id: 5, c: -1, src: path + "106/6.mp3"},
        {id: 6, c: -1, src: path + "106/7.mp3"},
        {id: 7, c: -1, src: path + "106/8.mp3"},
        {id: 8, c: -1, src: path + "106/9.mp3"},
        {id: 9, c: -1, src: path + "106/10.mp3"},
        {id: 10, c: -1, src: path + "106/11.mp3"},
        {id: 11, c: -1, src: path + "106/12.mp3"},
        {id: 12, c: -1, src: path + "106/end.mp3"}
    ];
    cantici[107] = [
        {id: 0, c: -1, src: path + "107/1.mp3"},
        {id: 1, c: -1, src: path + "107/2.mp3"},
        {id: 2, c: -1, src: path + "107/3.mp3"},
        {id: 3, c: -1, src: path + "107/4.mp3"},
        {id: 4, c: -1, src: path + "107/5.mp3"},
        {id: 5, c: -1, src: path + "107/6.mp3"},
        {id: 6, c: -1, src: path + "107/7.mp3"},
        {id: 7, c: -1, src: path + "107/8.mp3"},
        {id: 8, c: -1, src: path + "107/9.mp3"},
        {id: 9, c: -1, src: path + "107/10.mp3"},
        {id: 10, c: -1, src: path + "107/11.mp3"},
        {id: 11, c: -1, src: path + "107/12.mp3"},
        {id: 12, c: -1, src: path + "107/13.mp3"},
        {id: 13, c: -1, src: path + "107/14.mp3"},
        {id: 14, c: -1, src: path + "107/15.mp3"},
        {id: 15, c: -1, src: path + "107/16.mp3"},
        {id: 16, c: -1, src: path + "107/end.mp3"}
    ];
    cantici[115] = [
        {id: 0, c: -1, src: path + "115/1.mp3"},
        {id: 1, c: -1, src: path + "115/2.mp3"},
        {id: 2, c: -1, src: path + "115/3.mp3"},
        {id: 3, c: -1, src: path + "115/c1.mp3"},
        {id: 4, c: -1, src: path + "115/c2.mp3"},
        {id: 5, c: -1, src: path + "115/4.mp3"},
        {id: 6, c: -1, src: path + "115/5.mp3"},
        {id: 7, c: -1, src: path + "115/6.mp3"},
        {id: 8, c: 3, src: path + "115/c1.mp3"},
        {id: 9, c: 4, src: path + "115/c2.mp3"},
        {id: 10, c: -1, src: path + "115/7.mp3"},
        {id: 11, c: -1, src: path + "115/8.mp3"},
        {id: 12, c: -1, src: path + "115/9.mp3"},
        {id: 13, c: 3, src: path + "115/c1.mp3"},
        {id: 14, c: 4, src: path + "115/c2.mp3"},
        {id: 15, c: -1, src: path + "115/end.mp3"}
    ];
    cantici[116] = [
        {id: 0, c: -1, src: path + "116/1.mp3"},
        {id: 1, c: -1, src: path + "116/2.mp3"},
        {id: 2, c: -1, src: path + "116/3.mp3"},
        {id: 3, c: -1, src: path + "116/4.mp3"},
        {id: 4, c: -1, src: path + "116/c1.mp3"},
        {id: 5, c: -1, src: path + "116/c2.mp3"},
        {id: 6, c: -1, src: path + "116/5.mp3"},
        {id: 7, c: -1, src: path + "116/6.mp3"},
        {id: 8, c: -1, src: path + "116/7.mp3"},
        {id: 9, c: -1, src: path + "116/8.mp3"},
        {id: 10, c: 4, src: path + "116/c1.mp3"},
        {id: 11, c: 5, src: path + "116/c2.mp3"},
        {id: 12, c: -1, src: path + "116/end.mp3"}
    ];
    cantici[119] = [
        {id: 0, c: -1, src: path + "119/1.mp3"},
        {id: 1, c: -1, src: path + "119/2.mp3"},
        {id: 2, c: -1, src: path + "119/3.mp3"},
        {id: 3, c: -1, src: path + "119/4.mp3"},
        {id: 4, c: -1, src: path + "119/5.mp3"},
        {id: 5, c: -1, src: path + "119/6.mp3"},
        {id: 6, c: -1, src: path + "119/7.mp3"},
        {id: 7, c: -1, src: path + "119/8.mp3"},
        {id: 8, c: -1, src: path + "119/9.mp3"},
        {id: 9, c: -1, src: path + "119/10.mp3"},
        {id: 10, c: -1, src: path + "119/11.mp3"},
        {id: 11, c: -1, src: path + "119/12.mp3"},
        {id: 12, c: -1, src: path + "119/end.mp3"}
    ];
    cantici[121] = [
        {id: 0, c: -1, src: path + "121/1.mp3"},
        {id: 1, c: -1, src: path + "121/2.mp3"},
        {id: 2, c: -1, src: path + "121/3.mp3"},
        {id: 3, c: -1, src: path + "121/4.mp3"},
        {id: 4, c: -1, src: path + "121/5.mp3"},
        {id: 5, c: -1, src: path + "121/6.mp3"},
        {id: 6, c: -1, src: path + "121/7.mp3"},
        {id: 7, c: -1, src: path + "121/8.mp3"},
        {id: 8, c: -1, src: path + "121/9.mp3"},
        {id: 9, c: -1, src: path + "121/10.mp3"},
        {id: 10, c: -1, src: path + "121/11.mp3"},
        {id: 11, c: -1, src: path + "121/12.mp3"},
        {id: 12, c: -1, src: path + "121/end.mp3"}
    ];
    cantici[123] = [
        {id: 0, c: -1, src: path + "123/1.mp3"},
        {id: 1, c: -1, src: path + "123/2.mp3"},
        {id: 2, c: -1, src: path + "123/c1.mp3"},
        {id: 3, c: -1, src: path + "123/c2.mp3"},
        {id: 4, c: -1, src: path + "123/3.mp3"},
        {id: 5, c: -1, src: path + "123/4.mp3"},
        {id: 6, c: 2, src: path + "123/c1.mp3"},
        {id: 7, c: 3, src: path + "123/c2.mp3"},
        {id: 8, c: -1, src: path + "123/5.mp3"},
        {id: 9, c: -1, src: path + "123/6.mp3"},
        {id: 10, c: 2, src: path + "123/c1.mp3"},
        {id: 11, c: 3, src: path + "123/c2.mp3"},
        {id: 12, c: -1, src: path + "123/end.mp3"}
    ];
    cantici[124] = [
        {id: 0, c: -1, src: path + "124/1.mp3"},
        {id: 1, c: -1, src: path + "124/2.mp3"},
        {id: 2, c: -1, src: path + "124/3.mp3"},
        {id: 3, c: -1, src: path + "124/4.mp3"},
        {id: 4, c: -1, src: path + "124/5.mp3"},
        {id: 5, c: -1, src: path + "124/6.mp3"},
        {id: 6, c: -1, src: path + "124/7.mp3"},
        {id: 7, c: -1, src: path + "124/8.mp3"},
        {id: 8, c: -1, src: path + "124/end.mp3"}
    ];
    cantici[134] = [
        {id: 0, c: -1, src: path + "134/1.mp3"},
        {id: 1, c: -1, src: path + "134/2.mp3"},
        {id: 2, c: -1, src: path + "134/3.mp3"},
        {id: 3, c: -1, src: path + "134/4.mp3"},
        {id: 4, c: -1, src: path + "134/c1.mp3"},
        {id: 5, c: -1, src: path + "134/c2.mp3"},
        {id: 6, c: -1, src: path + "134/5.mp3"},
        {id: 7, c: -1, src: path + "134/6.mp3"},
        {id: 8, c: -1, src: path + "134/7.mp3"},
        {id: 9, c: -1, src: path + "134/8.mp3"},
        {id: 10, c: 4, src: path + "134/c1.mp3"},
        {id: 11, c: 5, src: path + "134/c2.mp3"},
        {id: 12, c: -1, src: path + "134/end.mp3"}
    ];
    cantici[139] = [
        {id: 0, c: -1, src: path + "139/1.mp3"},
        {id: 1, c: -1, src: path + "139/2.mp3"},
        {id: 2, c: -1, src: path + "139/c1.mp3"},
        {id: 3, c: -1, src: path + "139/c2.mp3"},
        {id: 4, c: -1, src: path + "139/3.mp3"},
        {id: 5, c: -1, src: path + "139/4.mp3"},
        {id: 6, c: 2, src: path + "139/c1.mp3"},
        {id: 7, c: 3, src: path + "139/c2.mp3"},
        {id: 8, c: -1, src: path + "139/5.mp3"},
        {id: 9, c: -1, src: path + "139/6.mp3"},
        {id: 10, c: 2, src: path + "139/c1.mp3"},
        {id: 11, c: 3, src: path + "139/c2.mp3"},
        {id: 12, c: -1, src: path + "139/end.mp3"}
    ];
    cantici[141] = [
        {id: 0, c: -1, src: path + "141/1.mp3"},
        {id: 1, c: -1, src: path + "141/2.mp3"},
        {id: 2, c: -1, src: path + "141/3.mp3"},
        {id: 3, c: -1, src: path + "141/4.mp3"},
        {id: 4, c: -1, src: path + "141/5.mp3"},
        {id: 5, c: -1, src: path + "141/6.mp3"},
        {id: 6, c: -1, src: path + "141/c1.mp3"},
        {id: 7, c: -1, src: path + "141/c2.mp3"},
        {id: 8, c: -1, src: path + "141/c3.mp3"},
        {id: 9, c: -1, src: path + "141/7.mp3"},
        {id: 10, c: -1, src: path + "141/8.mp3"},
        {id: 11, c: -1, src: path + "141/9.mp3"},
        {id: 12, c: -1, src: path + "141/10.mp3"},
        {id: 13, c: -1, src: path + "141/11.mp3"},
        {id: 14, c: -1, src: path + "141/12.mp3"},
        {id: 15, c: -1, src: path + "141/13.mp3"},
        {id: 16, c: 6, src: path + "141/c1.mp3"},
        {id: 17, c: 7, src: path + "141/c2.mp3"},
        {id: 18, c: 8, src: path + "141/c3.mp3"},
        {id: 19, c: -1, src: path + "141/end.mp3"}
    ];
    cantici[143] = [
        {id: 0, c: -1, src: path + "143/1.mp3"},
        {id: 1, c: -1, src: path + "143/2.mp3"},
        {id: 2, c: -1, src: path + "143/c1.mp3"},
        {id: 3, c: -1, src: path + "143/c2.mp3"},
        {id: 4, c: -1, src: path + "143/3.mp3"},
        {id: 5, c: -1, src: path + "143/4.mp3"},
        {id: 6, c: 2, src: path + "143/c1.mp3"},
        {id: 7, c: 3, src: path + "143/c2.mp3"},
        {id: 8, c: -1, src: path + "143/end.mp3"}
    ];
    cantici[150] = [
        {id: 0, c: -1, src: path + "150/1.mp3"},
        {id: 1, c: -1, src: path + "150/2.mp3"},
        {id: 2, c: -1, src: path + "150/c1.mp3"},
        {id: 3, c: -1, src: path + "150/c2.mp3"},
        {id: 4, c: -1, src: path + "150/3.mp3"},
        {id: 5, c: -1, src: path + "150/4.mp3"},
        {id: 6, c: 2, src: path + "150/c1.mp3"},
        {id: 7, c: 3, src: path + "150/c2.mp3"},
        {id: 8, c: -1, src: path + "150/5.mp3"},
        {id: 9, c: -1, src: path + "150/6.mp3"},
        {id: 10, c: 2, src: path + "150/c1.mp3"},
        {id: 11, c: 3, src: path + "150/c2.mp3"},
        {id: 12, c: -1, src: path + "150/end.mp3"}
    ];
    cantici[151] = [
        {id: 0, c: -1, src: path + "151/1.mp3"},
        {id: 1, c: -1, src: path + "151/2.mp3"},
        {id: 2, c: -1, src: path + "151/c1.mp3"},
        {id: 3, c: -1, src: path + "151/c2.mp3"},
        {id: 4, c: -1, src: path + "151/3.mp3"},
        {id: 5, c: -1, src: path + "151/4.mp3"},
        {id: 6, c: 2, src: path + "151/c1.mp3"},
        {id: 7, c: 3, src: path + "151/c2.mp3"},
        {id: 8, c: -1, src: path + "151/5.mp3"},
        {id: 9, c: -1, src: path + "151/6.mp3"},
        {id: 10, c: 2, src: path + "151/c1.mp3"},
        {id: 11, c: 3, src: path + "151/c2.mp3"},
        {id: 12, c: -1, src: path + "151/end.mp3"}
    ];
    cantici[154] = [
        {id: 0, c: -1, src: path + "154/1.mp3"},
        {id: 1, c: -1, src: path + "154/2.mp3"},
        {id: 2, c: -1, src: path + "154/3.mp3"},
        {id: 3, c: -1, src: path + "154/c1.mp3"},
        {id: 4, c: -1, src: path + "154/c2.mp3"},
        {id: 5, c: -1, src: path + "154/4.mp3"},
        {id: 6, c: -1, src: path + "154/5.mp3"},
        {id: 7, c: -1, src: path + "154/6.mp3"},
        {id: 8, c: 3, src: path + "154/c1.mp3"},
        {id: 9, c: 4, src: path + "154/c2.mp3"},
        {id: 10, c: -1, src: path + "154/7.mp3"},
        {id: 11, c: -1, src: path + "154/8.mp3"},
        {id: 12, c: -1, src: path + "154/9.mp3"},
        {id: 13, c: 3, src: path + "154/c1.mp3"},
        {id: 14, c: 4, src: path + "154/c2.mp3"},
        {id: 15, c: -1, src: path + "154/end.mp3"}
    ];

    function pippo(item) {
        cantico = item;
        document.getElementById("list").setAttribute("style", "display:none;");
        document.getElementById("wait").removeAttribute("style");
        queue = new createjs.LoadQueue();
        queue.installPlugin(createjs.Sound);
        queue.on("fileload", handleLoad, this);
        queue.loadManifest(cantici[item]);

        function handleLoad(event) {
            var item = event.item;
            loaded.push(item.id);
            document.getElementById("wait").setAttribute("style", "display:none;");
            document.getElementById("controls").removeAttribute("style");
        }
    }

    function stop() {
        createjs.Sound.stop();
    }

    function playNext() {
        //HA FINITO IL CANTICO
        if (currentMP3 == cantici[cantico].length - 1) {
            goBack();
            return;
        }

        var nextMP3 = currentMP3 + 1;

        //CONTROLLO SE MP3 = CORO
        if (!loaded.contains(nextMP3)) {
            var mp3 = cantici[cantico][nextMP3];

            if (mp3.c > -1) {
                currentMP3 = nextMP3;
                stop();
                createjs.Sound.play(mp3.c);
                return;
            }
        }

        //MP3 NON IN CACHE
        if (!loaded.contains(nextMP3)) return;

        currentMP3 = nextMP3;
        stop();
        createjs.Sound.play(nextMP3);
    }

    function goBack() {
        cantico = -1;
        currentMP3 = -1;
        loaded = [];
        stop();
        queue.removeAll();
        queue.reset();
        queue.destroy();
        document.getElementById("controls").setAttribute("style", "display:none;");
        document.getElementById("list").removeAttribute("style");
    }
</script>
</body>
</html>