<?php
$row = 1;
$path=$_POST['path'];
$size=$_POST['size'];
$faces=$_POST['faces'];
$color=$_POST['color'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
$sd=$sdate;
$ed=$edate;
if($sdate=="") $sdate="01/01/2006";
if($edate=="") $edate="01/01/2014";
$count=0;


if(substr($path,-1)=='/')
$fullpath="http://127.0.0.1/".$path;
else if ($path!="")
$fullpath="http://127.0.0.1/".$path."/";
else $fullpath="http://127.0.0.1/hacku/";
$textfile=$fullpath."test.txt";


if (($handle = fopen($textfile, "r")) !== FALSE) {

	include_once("header.php");
	echo"<font face= 'arial' color='wheat'> <br/>";
    echo "

<div id='content'>
<form  action='results.php' method='POST'>
<input type='text' class='textbox' name='path' value='". $path."' placeholder=' Type the pathname of folder' style='width:280px;' />

<select class='textbox' name='size'>
    <option value='Size'>".$size."</option>
    <option value='low' >Low</option>
    <option value ='medium'>Medium</option>
    <option value='high'>High</option>
</select>

<input type='text' class='textbox' name='faces' value='". $faces."' placeholder=' No. of Faces' style='width:150px;' />

<select class='textbox' name='color' value='". $color."'>
    <option value'Color'>Color</option>
    <option value='red' >Red</option>
    <option value ='blue'>Blue</option>
    <option value='green'>Green</option>
    <option value='white'>Bright</option>
    <option value='black'>Dark</option>
</select>
<input type='text' class='textbox' id='datepicker' placeholder='Start Date' value='". $sd."'  name ='sdate' style:'width:50px;'/>
<input type='text' class='textbox' id='datepicker2' placeholder='End Date' value='". $ed."'  name ='edate' style:'width:50px;'/>



<input class='textbox' type='submit' value='Search'>

</form>




</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/>

<div style='margin-left:5%'>

    ";


    


    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        $ans=1;
        
        
        if($faces!="")
        {
            if(($data[1])<5)
            {
                
                if($data[1]==$faces)
                {
                    $ans=1;

                }
                else continue;
            }
            else
            {
                if(($data[1]>=$faces-1)&&($data[1]<=$faces+1))
                {
                    $ans=1;
                }
                else continue;

            }
        }

        if($size!="Size")
        { 
            if(($size=="low") && ($data[2]>150))

            {
                continue;
            }

            if(($size=="medium")&&(($data[2]<100)||($data[2]>700)))
            {
                continue;

            }
            if(($size=="high")&&($size<500))
            {
                continue;
            }
        }
        
        $data[3]=substr($data[3],2);
        
        $data[7]=substr($data[7],0,-1);
        


        if($color!="Color")
        {
            if($color=="red" && $data[3]<35)
                continue;
            if($color=="green" && $data[4]<35)
                continue;
            if($color=="blue" && $data[5]<35)
                continue;
            if($color=="white" && $data[6]<25)
                continue;
            if($color=="black" && $data[7]<25)
                continue;
        }

      list($ms,$ds,$ys)=explode('/',$sdate);

        list($me,$de,$ye)=explode('/',$edate);

        
        list($a0,$a1,$a2,$a3,$a4,$a5)=explode(' ',$data[8]);

        $a5=substr($a5,0,-2);
        
        
       switch($a2)
        {
            case "Jan" : $a2=1; break;
            case "Feb" : $a2=2; break;
            case "Mar" : $a2=3; break;
            case "Apr" : $a2=4; break;
            case "May" : $a2=5; break;
            case "Jun" : $a2=6; break;
            case "Jul" : $a2=7; break;
            case "Aug" : $a2=8; break;
            case "Sep" : $a2=9; break;
            case "Oct" : $a2=10; break;
            case "Nov" : $a2=11; break;
            case "Dec" : $a2=12; break;
            default : $a2=1; break;

        }
       if($a5>$ye)continue;
            else if($a5==$ye)
            {
                if($a2>$me)continue;
                else if($a2==$me)
                {
                    if($a3>$de)continue;
                }
            }
            if($a5<$ys)continue;
            else if($a5==$ys)
            {
                if($a2<$ms)continue;
                else if($a2==$ms)
                {
                    if($a3<$ds)continue;
                }
            }

        



        $data[0]=substr($data[0],2,-1);
        $filepath=$fullpath.$data[0];
        if ($ans==1)
        {
            echo "<a href='";
            echo $filepath;
            echo "' target='_blank'>";

            echo"<img src='";
            echo $filepath;
            echo "' class='image' alt='"; 
            echo "Name: ".$data[0].". "."Size: ".$data[2]."KB. "."Date Added: ".$data[8];
            echo"'></a>";
            echo "&emsp;";
            $count++;

        }


    }
    fclose($handle);
    echo "<p><h1>Showing "; echo $count; echo " results.</h1></p>";


    echo "</div></font>";


    include_once("footer.php");
}


 else if (!file_exists($textfile))
 	{
	include_once("header.php");
	echo " <font face= 'arial' color='wheat'><h1 align='center' ><br/><br/>
    <br/><br/><br/><br/> Folder has not been Bucketed</h1>
";
echo $textfile;
echo"
    </font> ";

	
    include_once("footer.php");
}

?>






