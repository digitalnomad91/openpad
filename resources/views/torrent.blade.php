<!DOCTYPE html>
<html lang="en">

<head>
    <title>Instant.io - Streaming file transfer over WebTorrent</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="search" href="http://openpad.io:9100/opensearch.xml" title="Instant.io" type="application/opensearchdescription+xml">
    <link rel="stylesheet" href="http://openpad.io:9100/main.css" charset="utf-8">
</head>

<body>
    <main>
        <picture class="logo">
            <source srcset="http://openpad.io:9100/logo.svg"><img src="http://openpad.io:9100/logo.png" alt="Instant.io"></picture>
        <p class="subtitle">Streaming file transfer over <a href="http://webtorrent.io" target="_blank">WebTorrent</a> (torrents on the web)</p>
        <h1 id="logHeading" style="display: none">Log</h1>
        <div class="speed"></div>
        <div class="log"></div>
        <section>
            <h1>Start sharing</h1>
            <p>Drag-and-drop files to begin seeding. Or choose a file:
                <input type="file" name="upload" multiple>
            </p>
        </section>
        <section>
            <h1>Start downloading</h1>
            <form>
                <label for="torrentId">Download from a magnet link or info hash</label>
                <input name="torrentId" placeholder="magnet:" required>
                <button type="submit">Download</button>
            </form>
        </section>
        <footer>
            <p><small>Powered by <a href="http://webtorrent.io" target="_blank">WebTorrent</a>. Works in Chrome, Firefox, and Opera. Source code available on <a href="https://github.com/feross/instant.io" target="_blank">GitHub</a>, 100% open source, free software. © 2016 WebTorrent, LLC.</small></p>
        </footer>
    </main>
    <script src="http://openpad.io:9100/bundle.js"></script>

    
    
    
    
    
    
    
    
    
    

    
</body>

</html>