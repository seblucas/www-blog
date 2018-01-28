---
title: "Migration du site sur Hugo - Mise en place recherche"
date: 2018-01-28
tags: [blog,hugo]
slug: blog-migration-hugo-2
disqus_identifier: /blog/blog-migration-hugo-2
series: ["Migration Hugo"]
---
# Migration du site sur Hugo - Mise en place recherche

## Contexte

Dans la version précédente du site, j'avais quand même fini par ajouter une recherche faite via un bon vieux grep.
Ce n'était certainement pas top (et cela avait peut être des incidences en termes de sécurité) mais un site sans recherche c'est un peu limite.

Au début je pensais passer par Google Search mais à priori ils arrêtent de fournir ce service et au final cela tombe bien car la mise en place de la recherche avec Hugo n'est pas si compliquée.

Je suis parti de cet [article de blog](https://www.marmanold.com/tech/full-text-search-using-hugo--lunr/).
Je vais donc utiliser [lunr](https://lunrjs.com/) et cela marche pas mal.

## Comment faire ?

### Générer un index au format Json

Pas très compliqué car Hugo est prêt pour ça il faut juste créer le fichier `index.json` dans le répertoire `layout` de mon thème :

```
[
    {{ range $i, $e := .Site.RegularPages }}

    {{- if $i }}, {{ end }}
        {
            "uri": {{ .Permalink | relURL | jsonify }},
            "title": {{ .Title | jsonify }},
            "language": {{ .Lang | jsonify }},
            "content": {{ .Plain | jsonify }},
            "tags": [
                {{- range $ii, $ee := .Params.tags }}
                {{- if $ii }}, {{- end }}
                    {{ $ee | jsonify }}
                {{- end }}
            ]
        }
    {{- end }}
]
```

Il faut ensuite modifier le `config.toml` :

```toml
[outputs]
home = ["HTML", "CSS", "RSS", "JSON"]
```

J'ai donc accès à `/index.json` et `/fr/index.json`. Ces deux fichiers contiennent tout le contenu de chaque page sans aucune balise HTML.

### Générer un index spécifique à lunr

Cette opération pourrait se faire en live sur la page de recherche (côté client).
Pour éviter de perdre du temps, je le génère statiquement via gulp :

```js
gulp.task('lunr-index', () => {
  const documentsEn = JSON.parse(fs.readFileSync('public/index.json'));
  const documentsFr = JSON.parse(fs.readFileSync('public/fr/index.json'));

  var titleMap = {};

  let lunrIndex = lunr(function() {
        this.use(lunr.multiLanguage('en', 'fr'));

        this.field("title", {
            boost: 10
        });
        this.field("tags", {
            boost: 5
        });
        this.field("content");
        this.ref("uri");

        documentsEn.forEach(function(doc) {
            titleMap[doc.uri] = doc.title;
            this.add(doc);
        }, this);
        documentsFr.forEach(function(doc) {
            titleMap[doc.uri] = doc.title;
            this.add(doc);
        }, this);
    });

  fs.writeFileSync('public/js/lunr-index.json', JSON.stringify(lunrIndex));
  fs.writeFileSync('public/js/title-map.json', JSON.stringify(titleMap));
});
```

Cette tâche génère deux fichiers :

 * `lunr-index.json` : l'index qui va être utilisé par lunr.
 * `title-map.json` : un simple tableau json qui permet d'avoir le titre d'une page à partir de son URL.

### Création d'une page de recherche

J'ai simplement créé le fichier `search.html` dans le répertoire `layouts/_default` et la partie intéressante est :

* Chargement du fichier d'index

```js
    // Start loading the json index as soon as possible
    fetchAsync('/js/lunr-index.json')
    .then(data => {
        //debugger;
        try {
            idx = lunr.Index.load(data);
            console.log('Search ready');
            searchBox.placeholder = 'Just start typing...';
            searchBox.disabled = false;
        }
        catch (e) {
            console.log (e);
        }
    })
    .catch(reason => console.log(reason.message));
```

* Lancement d'une recherche

```js
function processForm(e) {
    if (e.preventDefault) e.preventDefault();
    console.log('Search started');
    let res = idx.search(searchBox.value);

    // purge old results
    while (results.firstChild) {
        results.removeChild(results.firstChild);
    }
    res.forEach(function (el) {
        let liTag = document.createElement('li');
        let aTag = document.createElement('a');
        aTag.setAttribute('href', el.ref);
        aTag.innerHTML = el.ref;
        if (titleMap.hasOwnProperty(el.ref)) {
            aTag.innerHTML = titleMap[el.ref];
        }
        liTag.appendChild(aTag);
        results.appendChild(liTag);
    });
    return false;
}
```

Le fichier complet est visible [ici](https://github.com/seblucas/www-blog/blob/hugo/themes/cocoa-eh/layouts/_default/search.html).

## Conclusion

Le fichier d'index de lunr fait 2,59Mo (environ 440Ko en gzip) pour environ 400 articles.
Cela occasionne un léger délai lors de l'affichage de la page.
Je trouve cela acceptable mais pour de plus gros sites que moi cela peut être génant.

TODO :
 * Pour l'instant je n'ai pas ajouté le lien à la page de recherche dans l'index.
 * Ce serait sympa d'avoir le résumé des articles en résultats.