var slideheights = [];

function load()
{
	var i;
	
	for(i=0;i<document.getElementById("match_list").getElementsByTagName("li").length;i++)
	{
		var d = document.getElementById("slide_"+i);
		var b = document.getElementById("slide_button_"+i);
		var l = document.getElementById("slide_li_"+i);
		var s = document.getElementById("slide_span_"+i);
		slideheights[i] = d.clientHeight;
		
		d.setAttribute("style", "height:0px; padding-bottom: 0px;");
		b.innerHTML = "+";
		//l.setAttribute("style", "-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomright: 5px;-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomleft: 5px;margin-bottom:5px; font-size:18px;"); 
		//b.setAttribute("style","-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomleft: 5px;");
	}

	console.log(slideheights);
}

function expand(id)
{
	
	if(document.getElementById("slide_button_"+id).innerHTML!="+")
	{
		var d = document.getElementById("slide_"+id);
		d.setAttribute("style", "height: 0px;padding-bottom: 0px;");
		//d.style.height = '0px';
		
		var b = document.getElementById("slide_button_"+id);
		b.innerHTML = "+";
		
		var l = document.getElementById("slide_li_"+id);
		
		var s = document.getElementById("slide_span_"+id);
		
		
		l.className = l.className.replace( /(?:^|\s)dactive(?!\S)/g , '' );
		b.className = b.className.replace( /(?:^|\s)dactive(?!\S)/g , '' );
		s.className = b.className.replace( /(?:^|\s)dactive(?!\S)/g , '' );
	
		step(1,function(){ 
		if(d.style.height=="0px")
		{
		//l.setAttribute("style", "-webkit-border-bottom-right-radius: 5px;-moz-border-radius-bottomright: 5px;-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomleft: 5px;margin-bottom:5px; font-size:18px;"); 
		//b.setAttribute("style","-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomleft: 5px;");
		}
		});
	}
	else
	{
		var d = document.getElementById("slide_"+id);
		
		d.setAttribute("style", "height:"+slideheights[id] + "px;padding-bottom: 10px;");
		console.log(id + " " + slideheights[id]);
		
		var l = document.getElementById("slide_li_"+id);
		
		var b = document.getElementById("slide_button_"+id);
		
		var s = document.getElementById("slide_span_"+id);
		
		l.className+=" dactive";
		b.className+=" dactive";
		s.className+=" dactive";
		
		b.innerHTML = "-";
		
		//l.setAttribute("style", "-webkit-border-bottom-right-radius: 0px;-moz-border-radius-bottomright: 0px;-webkit-border-bottom-left-radius: 0px;-moz-border-radius-bottomleft: 0px;margin-bottom:0px;");
		//b.setAttribute("style","-webkit-border-bottom-left-radius: 0px;-moz-border-radius-bottomleft: 0px;");
		
		step(2,function(){ 
			d.style.opacity = '100'; 
		});
	}
}

function step(seconds, action)
{
	var counter = 0;
    var time = window.setInterval( function ()
    {
        counter++;
        if ( counter >= seconds )
        {
            action();
            window.clearInterval( time );
        }
    }, 1000 );
}
