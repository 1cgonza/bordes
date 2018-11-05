import * as PIXI from 'pixi.js';
let stageW = window.innerWidth;
let stageH = window.innerHeight;
let player = document.getElementById('audioPlayer');
let audioSrc = document.getElementById('audioSrc');
let assets = `${basePath.templateUrl}/assets`;

let img = new Image();
img.onload = () => {
  Object.assign( img.style, {
    width: `${stageW}px`,
    height: `${stageH}px`,
    position: 'absolute',
    top: 0,
    left: 0
  });
  document.body.appendChild(img);
}
img.src = `${assets}/imgs/Drags-(0-03-09-10).png`;

var app = new PIXI.Application(stageW, stageH);
document.body.appendChild(app.view);

app.stage.interactive = true;

var container = new PIXI.Container();
app.stage.addChild(container);

var displacementSprite = PIXI.Sprite.fromImage(`${assets}/imgs/displace.png`);
var displacementFilter = new PIXI.filters.DisplacementFilter(displacementSprite);

app.stage.addChild(displacementSprite);

container.filters = [displacementFilter];

displacementFilter.scale.x = 110;
displacementFilter.scale.y = 110;
displacementSprite.anchor.set(0.5);

var bg = PIXI.Sprite.fromImage(`${assets}/imgs/Drags (0-03-09-10).jpg`);
bg.width = app.screen.width;
bg.height = app.screen.height;

container.addChild(bg);

app.stage
  .on('mousemove', onPointerMove)
  .on('touchmove', onPointerMove);

function onPointerMove(eventData) {
  displacementSprite.position.set(eventData.data.global.x - 25, eventData.data.global.y);
}

audioSrc.src = `${assets}/sounds/angelica01.mp3`;
player.load();

//player.play();

player.onloadeddata = () => {
  console.log('loaded', player.duration);
}

player.onplay = () => {
  console.log('start playing');
}

player.ontimeupdate = () => {
}