<script>
    function resizeBody(element){
        if(window.innerWidth < window.innerHeight || window.innerWidth < 700){
            element.style.marginLeft = '0px';
            element.style.paddingTop = '60px';
            element.style.minWidth = '1000px';
        }else{
            element.style.marginLeft = '200px';
            element.style.paddingTop = '0px';
            element.style.minWidth = '0px';
        }
    }
</script>