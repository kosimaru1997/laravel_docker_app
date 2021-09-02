function deleteHandle(event){
    event.preventDefault();
    if(window.confirm('本当に削除していいですか？')){
        document.getElementById('delete-form').submit();
    }else{
        alert('キャンセルしました');
    }
}

$(function(){
    $(".btn-dell").click(function(){
        if(confirm("本当に削除しますか？")){

        }else{
        //cancel
        return false;
        }
    });
});
