<script>
    function navVisibility(){
        if(window.innerWidth < 700){
            document.getElementById('nav_block').className = 'invisible';
        }else{
            document.getElementById('nav_block').className = 'visible';
        }
    }
    window.addEventListener('resize',navVisibility);
    if(window.innerWidth < 700){
        document.getElementById('nav_block').className = 'invisible';
    }else{
        document.getElementById('nav_block').className = 'visible';
    }
</script>