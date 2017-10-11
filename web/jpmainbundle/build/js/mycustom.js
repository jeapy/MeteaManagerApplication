

 var $collectionHolder;



 $(document).ready(function() {


 	// Get the ul that holds the collection of tags
    $collectionHolder = $('div#jp_financebundle_facture_facture_item');
    
    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $collectionHolder.find(':input').length;

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $('#item').click(function(e) {
      addItem($collectionHolder);
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });
    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
    if (index == 0) {
     addItem($collectionHolder);
    } else {
      // S'il existe déjà des catégories, on ajoute un lien de suppression pour chacune d'entre elles
      $collectionHolder.children('div').each(function() {
        addDeleteLink($(this));
      });
    }

    // La fonction qui ajoute un formulaire CategoryType
    function addItem($collectionHolder) {
      // Dans le contenu de l'attribut « data-prototype », on remplace :
      // - le texte "__name__label__" qu'il contient par le label du champ
      // - le texte "__name__" qu'il contient par le numéro du champ
      var template = $collectionHolder.attr('data-prototype')
        .replace(/__name__label__/g, 'Ligne de facture' + (index+1))
        .replace(/__name__/g,        index)
      ;
      // On crée un objet jquery qui contient ce template
      var $prototype = $(template);
      // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
      addDeleteLink($prototype);
      // On ajoute le prototype modifié à la fin de la balise <div>
      $collectionHolder.append($prototype);
      // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
      index++;
    }


    // La fonction qui ajoute un lien de suppression d'une catégorie
    function addDeleteLink($prototype) {
      // Création du lien
      var $deleteLink = $('<br> <a href="#" class="btn btn-danger btn-xs">supprimer</a> <hr>');
      // Ajout du lien
      $prototype.append($deleteLink);
      // Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
      $deleteLink.click(function(e) {
        $prototype.remove();
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
      });

    }

    //******************************************************************************//


	Dropzone.options.Myform = {
		  init: function() {
		//    this.on("addedfile", function(file) { 
		 //   	alert("Vous avez ajouter un fichier !"); 
		 //   });

		   this.on("complete", function(file) {
    				window.location.reload();
				});
		  }
};

Dropzone.options.Myform2 = {
		  init: function() {
		this.on("complete", function(file) {
    				window.location.reload();
				});
		  }
};

Dropzone.options.Myform3 = {
		  init: function() {
		   this.on("complete", function(file) {
    				window.location.reload();
				});
		  }
};

Dropzone.options.Myform4 = {
		  init: function() {
		   this.on("complete", function(file) {
    				window.location.reload();
				});
		  }
};



function postForm( $form, callback ){ 
  /*
   * Get all form values
   */
  var values = {};
  $.each( $form.serializeArray(), function(i, field) {
    values[field.name] = field.value;
  }); 
  /*
   * Throw the form values to the server!
   */
  $.ajax({
    type        : $form.attr( 'method' ),
    url         : $form.attr( 'action' ),
    data        : values,
    success     : function(data) {
      callback( data );
    }
  });
 
}
var $sport = $('#jp_financebundle_facture_numfacture');
var $btn =  $('#valider');
// When sport gets selected ...
$btn.click(function() {
 
  $( 'form' ).submit( function( e ){
    e.preventDefault();
 
    postForm( $(this), function( response ){
    });
 
    return false;
  });
});
	
 });



