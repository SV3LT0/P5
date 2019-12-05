class App {
    constructor(apiUrl, token){
        this.apiUrl = apiUrl;

        this.zoneMovies = document.getElementById('movies');
        this.zonePerso = document.getElementById('perso');

        this.h = new Headers();
        this.h.append('Authorization', 'Bearer '+token)

        

        this.initApiFilm(this.zoneMovies);
        this.initApiPerso(this.zonePerso);

    }


    async initApiFilm(zoneMovies){
        fetch(this.apiUrl+"movie",{
                method:'GET',
                headers: this.h
                })
        .then(function(response){
            return response.json()
        }).then(function(data){
            console.log(data)
            let films = data
            data.docs.forEach(film => {
                console.log(film.name);
                let titreFilm = document.createElement("h3");
                titreFilm.textContent= film.name;
                zoneMovies.appendChild(titreFilm);
                let infoNomination = document.createElement("li");
                infoNomination.textContent= "Nominations aux Oscars : "+film.academyAwardNominations;
                zoneMovies.appendChild(infoNomination);
                let infoAwards = document.createElement("li");
                infoAwards.textContent= "Oscars remportés  : "+film.academyAwardWins;
                zoneMovies.appendChild(infoAwards);
                let infoBoxOffice = document.createElement("li");
                infoBoxOffice.textContent= "Box Office : "+film.boxOfficeRevenueInMillions+" M";
                zoneMovies.appendChild(infoBoxOffice);
                let infoBudget = document.createElement("li");
                infoBudget.textContent= "Budget : "+film.budgetInMillions+" M$";
                zoneMovies.appendChild(infoBudget);
            });
        })
    };



    async initApiPerso(){
        fetch(this.apiUrl+"character",{
            method:'GET',
            headers: this.h
            })
        .then(function(response){
            return response.json()
        }).then(function(data){
            console.log(data);
            let p=1;
            let i=1;
            app.createTable(p);
            data.docs.forEach(perso => {
                if (i<50) {
                    i++;
                    app.addLine(p, perso);
                }else{
                    i=1
                    p++
                    app.createTable(p);
                    app.addLine(p, perso);
                    let nav = document.getElementById('navPerso');
                    let lienNav = document.createElement('a');
                    lienNav.href = "javascript: onClick=app.showPage("+p+")";
                    lienNav.textContent =p;
                    nav.appendChild(lienNav);
                    
                    document.getElementById('page'+p).style.display='none';
                }
            })
        })
    }

    createTable(p){
        let corps = document.getElementById('corps');
        let table = document.createElement('table');
        table.id='page'+p;
        let entete = document.createElement('tr');
        let thName = document.createElement('th');
        thName.textContent = 'Nom';
        entete.appendChild(thName);
        let thNaissance = document.createElement('th');
        thNaissance.textContent ='Naissance';
        entete.appendChild(thNaissance);
        let thDeath = document.createElement('th');
        thDeath.textContent ='Mort';
        entete.appendChild(thDeath);
        let thRace = document.createElement('th');
        thRace.textContent = 'Race';
        entete.appendChild(thRace);
        let thRealm = document.createElement('th');
        thRealm.textContent = 'Royaume';
        entete.appendChild(thRealm);
        let thWiki = document.createElement('th');
        thWiki.textContent = 'Wiki';
        entete.appendChild(thWiki);
        table.appendChild(entete);
        corps.appendChild(table);

    }

    addLine(p, perso){
        let table = document.getElementById('page'+p)
        let ligne = document.createElement('tr');
        let name = document.createElement('td');
        name.textContent = perso.name;
        ligne.appendChild(name);
        let birth = document.createElement('td');
        birth.textContent = perso.birth;
        ligne.appendChild(birth);
        let death = document.createElement('td');
        death.textContent = perso.death;
        ligne.appendChild(death);
        let race = document.createElement('td');
        race.textContent = perso.race;
        ligne.appendChild(race);
        let realm = document.createElement('td');
        realm.textContent = perso.realm;
        ligne.appendChild(realm);
        let wiki = document.createElement('td');
        let wikiUrl=document.createElement('a');
        wikiUrl.href = perso.wikiUrl
        wikiUrl.textContent = "Plus d'info";
        wiki.appendChild(wikiUrl);
        ligne.appendChild(wiki);
        table.appendChild(ligne);
    }

    showPage(id){
        let p = document.getElementById('navPerso').childElementCount;
        for (let i = 1; i < p+1; i++) {
            if (i===id) {
                let showThis = document.getElementById("page"+id);
                showThis.style.display="block";
            } else {
            let hideThis = document.getElementById("page"+i);
                hideThis.style.display = "none";
            }
        }
    }
}

const app = new App("https://the-one-api.herokuapp.com/v1/","sapf15QSPoXlNfGFYoWu")