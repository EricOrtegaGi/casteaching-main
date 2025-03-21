# Paquet NPM

Pujat a npmjs: https://www.npmjs.com/package/casteaching

Instal·lació:

```bash 
npm install casteaching
``` 

Exemple d'ús:

```javascript
import casteaching from 'casteaching'

// Obtenir llista de vídeos publicats
casteaching.videos()

// Obtenir vídeo per ID
casteaching.video.show(1)

// Crear video
casteaching.video.create({name: 'PHP 101', description: 'Bla bla bla',  url: 'https://youtube.com/...' })

// Update video
casteaching.video.update(1,{name: 'PHP 101', description: 'Bla bla bla',  url: 'https://youtube.com/...' })

// Destroy
casteaching.video.destroy(1)
```

## Truc, Local paths

Fitxer package.json, utilitzar "file:":

```json
{
    "private": true,
    "scripts": {
        "dev": "npm run development",
        ...
    },
    "dependencies": {
        "casteaching": "file:./casteaching_package",
        "vue": "^2.6.14"
    },
    "devDependencies": {
        "@tailwindcss/forms": "^0.3.1",
        ...
    }
}
``` 

## Com es publica un paquet

- Crear un usuari a npmjs
- Crear fitxer package.json amb npm init
- Logar-se amb npm login
- Publicar amb npm publisj
