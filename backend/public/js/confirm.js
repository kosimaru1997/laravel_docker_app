function deleteHandle(event){
    event.preventDefault();
    if(window.confirm('本当に削除していいですか？')){
        document.getElementById('delete-form').submit();
    }else{
        alert('キャンセルしました');
    }
}

// function deleteHandle(event){
//     event.preventDefault();
//     if(window.confirm('本当に削除していいですか？')){
//         document.getElementsByClassName('delete-form').submit();
//     }else{
//         alert('キャンセルしました');
//     }
// }
