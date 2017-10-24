<script>
    function onresize(){
        if(window.innerWidth < 700){
            document.getElementById('agenda_block').style = 'margin-left:0;';
        }else{
            document.getElementById('agenda_block').style = 'margin-left:200px;';
        }
    }
    window.addEventListener('resize',onresize);
    if(window.innerWidth < 700){
        document.getElementById('agenda_block').style = 'margin-left:0;';
    }else{
        document.getElementById('agenda_block').style = 'margin-left:200px;';
    }
</script>