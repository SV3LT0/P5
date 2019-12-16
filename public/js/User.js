class User {
    constructor(editFormId, formUserId){

        this.editFormId = editFormId;
        this.formUserId = formUserId;

        this.formEdit = document.getElementById(this.editFormId);
        this.formUser = document.getElementById(this.formUserId);

        this.regexPseudo = /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{2,}$/;
        this.regexMdp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)*.{6,}$/;

        this.msgError = document.getElementById('msgError');
        this.confirmation = document.getElementById('confirmation');

        if (this.formEdit) {
            this.formEdit.addEventListener('submit',this.validerEdition.bind(this));
        } else if (this.formUser) {
            this.formUser.addEventListener('submit',this.validerInscription.bind(this));
        }
    }

    validerEdition(e){
        const newPseudo = document.getElementById('newPseudo');
        const newMdp1 = document.getElementById('newMdp1');
        const newMdp2 = document.getElementById('newMdp2');

        if (newPseudo.textLength == 0){
            if (newMdp1.textLength== 0 && newMdp2.textLength== 0) {
                this.msgError.textContent="Veuillez renseigner les champs ci-dessus pour effectuer des modifications"
                e.preventDefault();
            } else if (newMdp1.textLength== 0 || newMdp2.textLength== 0) {
                this.msgError.textContent="Veuillez taper deux fois votre nouveau mot de passe"
                e.preventDefault();
            } else if (newMdp1.value!=newMdp2.value) {
                this.msgError.textContent="Vos deux mot de passe ne correspondent pas";
                e.preventDefault();
            } else if (!this.regexMdp.test(newMdp1.value)){
                this.msgError.textContent="Votre mot de passe doit contenir au moins 6 caractères avec au moins une majuscule, une minuscule et un chiffre";
                e.preventDefault();  
            }
        } else if (!this.regexPseudo.test(newPseudo.value)) {
            this.msgError.textContent="Votre pseudo doit etre d'au moins 2 caractères et ne peut contenir de caratères spéciaux";
            e.preventDefault();
        } else if (newMdp1.textLength== 0 && newMdp2.textLength== 0) {
            this.confirmation.textContent = "Votre pseudo à bien été modifié";
        } else if (newMdp1.textLength== 0 || newMdp2.textLength== 0) {
            this.msgError.textContent="Veuillez taper deux fois votre nouveau mot de passe"
            e.preventDefault();
        } else if (newMdp1.value!=newMdp2.value){
            this.msgError.textContent="Vos deux mot de passe ne correspondent pas";
            e.preventDefault();
        } else if (!this.regexMdp.test(newMdp1.value)){
            this.msgError.textContent="Votre mot de passe doit contenir au moins 6 caractères avec au moins une majuscule, une minuscule et un chiffre";
            e.preventDefault();  
        }
    }

    validerInscription(e){
        const pseudo = document.getElementById('pseudo');
        const mdp = document.getElementById('mdp');
        const verifMdp = document.getElementById('verifMdp');

        if (pseudo.textLength == 0 || mdp.textLength == 0 || verifMdp.textLength == 0) {
            this.msgError.textContent="Veuillez remplir tous les champs ci-dessus";
            e.preventDefault();
        } else if (!this.regexPseudo.test(pseudo.value)){
            this.msgError.textContent="Votre pseudo doit etre d'au moins 2 caractères et ne peut contenir de caratères spéciaux";
            e.preventDefault();
        } else if (verifMdp.value!=mdp.value) {
            this.msgError.textContent="Vos deux mot de passe ne correspondent pas";
            e.preventDefault();
        } else if (!this.regexMdp.test(mdp.value)){
            this.msgError.textContent="Votre mot de passe doit contenir au moins 6 caractères avec au moins une majuscule, une minuscule et un chiffre";
            e.preventDefault();
        } else {
            this.confirmation.textContent = "Votre compte a bien été créé";
        }
    }
}


const user = new User("editForm", "formUser");