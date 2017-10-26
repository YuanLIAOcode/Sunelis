<script>
    function setPowerImageSrc(element,file){
        element.src = file;
    }
</script>
<script>
    function changeHeader(){
        if(window.innerWidth < window.innerHeight || window.innerWidth < 700){
            document.getElementById('vertical_header').className = 'visible'
            document.getElementById('horizontal_header').className = 'invisible';
        }else{
            document.getElementById('horizontal_header').className = 'visible';
            document.getElementById('vertical_header').className = 'invisible'
        }
    }
    window.addEventListener('resize',changeHeader);
    if(window.innerWidth < window.innerHeight || window.innerWidth < 700){
        document.getElementById('vertical_header').className = 'visible'
        document.getElementById('horizontal_header').className = 'invisible';
    }else{
        document.getElementById('horizontal_header').className = 'visible';
        document.getElementById('vertical_header').className = 'invisible'
    }

</script>