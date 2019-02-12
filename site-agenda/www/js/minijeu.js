      $(function() {
        $('#start').click(function() {
          $('#conteneur').load('Question1.html', function() {
           
			$('#jeu').innerHTML="jeu"; 
          });
        });
      
        $('#Reponse').click(function() {
          $('#conteneur').load('Reponse1.html', function() {
            alert('Reponse 1: ');
          });
        });
      });