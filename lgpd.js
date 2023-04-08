let lgpdUrl = 'https://jsonplaceholder.typicode.com/posts';
let lgpdHtml = "<div class='lgpd'><div class='lgpd--left'>Utilizamos cookies do próprio navegador para melhorar sua experiência de navegação, para carregamento de imagens entre outros. <br />Para conferir detalhes sobre os cookies que utilizamos leia os termos clicando neste link <a href='https://medhub.app.br/termos-lgpd.php' target='_blank'>TERMOS LGPD</a>.</div><div class='lgpd--right'><form action='' method='POST'><input type='hidden' name='ip_lgpd' value='<?= $ip?>'><button type='submit' name'cadastrar'>OK</button></form></div></div><link rel='stylesheet' href='lgpd.css'>";


let lsContent = localStorage.getItem('lgpd');
if(!lsContent) {
   document.body.innerHTML += lgpdHtml;

   let lgpdArea = document.querySelector('.lgpd');
   let lgpdButton = lgpdArea.querySelector('button');

   lgpdButton.addEventListener('click', async ()=>{
        lgpdArea.remove();
 
         let result = await fetch(lgpdUrl);
         let json = await result.json();

         if(json.error !=''){
            let id = '123';
            localStorage.setItem('lgpd', id);
            //localStorage.setItem('lgpd', json.id); - indentificar usuário
         }
 
        
   });
}
   