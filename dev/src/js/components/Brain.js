import { rand } from '../utils/helpers';
import Point from './Point';
import { colors } from '../utils/colors';

export default class Brain {
  constructor(tags, inner) {
    this.inner = !!inner;
    this.info = document.getElementById('info');
    this.canvas = document.getElementById('stage');
    this.ctx = this.canvas.getContext('2d');
    this.points = [];
    this.stageW = this.canvas.width = window.innerWidth;
    this.stageH = this.canvas.height = window.innerHeight;
    this.ctx.fillStyle = '#F5E6E6';
    this.ctx.globalAlpha = 0.1;
    const maxPoints = tags.length;

    for (let i = 0; i < maxPoints; i++) {
      this.points.push(
        new Point(
          this,
          tags[i],
          i,
          rand(200, this.stageW - tags[i].offsetWidth - 300),
          rand(200, this.stageH - tags[i].offsetHeight - 100),
          maxPoints
        )
      );
    }
  }

  loop = () => {
    let ctx = this.ctx;

    ctx.save();
    ctx.globalAlpha = 0.1;
    ctx.fillRect(0, 0, this.stageW, this.stageH);
    ctx.restore();

    let i = this.points.length;

    while (i--) {
      let point = this.points[i];
      let nextPoint = this.points[i + 1];
      point.update();
      point.render(ctx, nextPoint, i);
    }
    ctx.closePath();
    if (Math.random() > 0.98) {
      ctx.strokeStyle = colors[Math.floor(Math.random() * colors.length)];
    }
    ctx.stroke();

    requestAnimationFrame(this.loop);
  };
}
