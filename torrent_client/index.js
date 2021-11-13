var WebTorrent = require('webtorrent-hybrid')
var moment = require("moment");

var client = new WebTorrent()

var magnetURI = 'magnet:?xt=urn:btih:08eaea946e91b3ca9e2c2dfb585f1be954bb6afc&dn=Sango+-+Da+Rocinha+2+-+02+Tre%CC%82s+Horas.mp3&tr=udp%3A%2F%2Fexodus.desync.com%3A6969&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Ftracker.internetwarriors.net%3A1337&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80&tr=wss%3A%2F%2Ftracker.btorrent.xyz&tr=wss%3A%2F%2Ftracker.fastcast.nz&tr=wss%3A%2F%2Ftracker.openwebtorrent.com'
console.log("Starting transfer");

client.add(magnetURI, { path: '/var/www/openpad/nodejs/torrent_client/test_dir' }, function (torrent) {
  console.log("Added to client.");
  torrent.on('done', onDone)
  setInterval(onProgress, 500)
  onProgress()

  // Statistics
  function onProgress () {
    // Peers
    console.log(torrent.numPeers + (torrent.numPeers === 1 ? ' peer' : ' peers'))

    // Progress
    var percent = Math.round(torrent.progress * 100 * 100) / 100
    console.log(prettyBytes(torrent.downloaded))
    console.log(prettyBytes(torrent.length))

    // Remaining time
    var remaining
    if (torrent.done) {
      remaining = 'Done.'
    } else {
      remaining = moment.duration(torrent.timeRemaining / 1000, 'seconds').humanize()
      remaining = remaining[0].toUpperCase() + remaining.substring(1) + ' remaining.'
    }
    console.log(remaining)

    // Speed rates
    console.log(prettyBytes(torrent.downloadSpeed) + '/s')
    console.log( prettyBytes(torrent.uploadSpeed) + '/s')
  }
  function onDone () {
     console.log('torrent download finished')
     onProgress()
  }

  
})



// Human readable bytes util
function prettyBytes(num) {
  var exponent, unit, neg = num < 0, units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
  if (neg) num = -num
  if (num < 1) return (neg ? '-' : '') + num + ' B'
  exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1)
  num = Number((num / Math.pow(1000, exponent)).toFixed(2))
  unit = units[exponent]
  return (neg ? '-' : '') + num + ' ' + unit
}