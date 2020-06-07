$(function () {
    $('#game').on('click', function() {
       if(!confirm('メールアドレスを相手に公開します。よろしいですか？')){
        /* キャンセルの時の処理 */
        return false;
    }else{
        /*　OKの時の処理 */
 
        }
    });
});