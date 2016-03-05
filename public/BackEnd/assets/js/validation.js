onload =function(){
    var ele = document.querySelectorAll('.number-only')[0];
    ele.onkeypress = function(e) {
        if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
            return false;
    }
    ele.onpaste = function(e){
        e.preventDefault();
    }
}