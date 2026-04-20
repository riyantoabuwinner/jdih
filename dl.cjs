const https = require('https');
const fs = require('fs');

const ids = [
  '1nEPyZWo8n51NvcKUA4VWXbUdPlW3R4Ud',
  '1bKMfy6v4vtLC1bMoZMdyphOTiSKngfvq',
  '1nk6Adju-sTfgHNsB_PhFX8ixVLXCY6-O',
  '1tDdtm9OFVpitLJz4685kPI9xVj_7vFrM',
  '1rNFKDLid5QCww3uXVtgeWlJceGgW74Ku'
];

function dl(id) {
  https.get('https://drive.google.com/uc?export=download&id=' + id, res => {
    if(res.statusCode === 302 || res.statusCode === 303) {
      https.get(res.headers.location, r2 => {
        if(!r2.headers['content-type'].includes('text/html')) {
          const disp = r2.headers['content-disposition'] || '';
          const match = disp.match(/filename="?([^"]+)"?/);
          const name = match ? match[1] : id + '.png';
          
          const file = fs.createWriteStream('./public/img/' + name);
          r2.pipe(file);
          
          file.on('finish', () => {
            console.log('Downloaded ' + name);
            file.close();
          });
        }
      });
    }
  });
}

ids.forEach(dl);
