<script>
    function onresize(){
        if(window.innerWidth < 700){
            document.getElementById('admin_accounts_block').style = 'margin-left:0;';
        }else{
            document.getElementById('admin_accounts_block').style = 'margin-left:200px;';
        }
    }
    window.addEventListener('resize',onresize);
    if(window.innerWidth < 700){
        document.getElementById('admin_accounts_block').style = 'margin-left:0;';
    }else{
        document.getElementById('admin_accounts_block').style = 'margin-left:200px;';
    }
</script>
<script>
    function setBackgroundColor(element,color){
        element.style.backgroundColor = color;
    }
    
    function setColor(element,color){
        element.style.color = color;
    }
</script>