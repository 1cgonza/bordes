import { rand } from '../utils/helpers';
import Brain from './Brain';
const twoPi = Math.PI * 2;

export default class Point {
  constructor(brain, ele, index, x, y, maxPoints) {
    this.brain = brain;
    this.ele = ele;
    this.fonts = [
      'Petit Formal Script',
      'PT Sans',
      'Arial',
      'Helvetica',
      'Times New Roman',
      'Times',
      'Courier New',
      'Courier',
      'Verdana',
      'Georgia',
      'Palatino',
      'Garamond',
      'Bookman',
      'Comic Sans MS',
      'Trebuchet MS',
      'Arial Black',
      'Impact'
    ];
    this.coord = {
      x: x,
      y: y
    };
    this.edges = {
      right: this.brain.stageW - this.ele.offsetWidth - 100,
      bottom: this.brain.stageH - this.ele.offsetHeight - 100
    };
    this.angle = rand(0, twoPi);
    this.speed = rand(0.2, 2.5);
    this.velocity = {
      x: Math.cos(this.angle) * this.speed,
      y: Math.sin(this.angle) * this.speed
    };
    this.radius = index == maxPoints - 1 ? 50 : rand(3, 10);
    this.master = index == maxPoints - 1;

    this.ele.onmouseover = () => {
      this.velocity = {
        x: 0,
        y: 0
      };
    };

    this.ele.onmouseout = () => {
      this.velocity = {
        x: Math.cos(this.angle) * this.speed,
        y: Math.sin(this.angle) * this.speed
      };
    };

    this.ele.onclick = e => {
      const posts = JSON.parse(this.ele.dataset.posts);
      let info = this.brain.info;
      info.innerText = '';
      let title = document.createElement('h1');
      title.className = 'infoTitle';
      title.innerText = e.target.innerText;
      info.appendChild(title);

      let postsWrapper = document.createElement('div');
      postsWrapper.className = 'postsWrapper';
      info.appendChild(postsWrapper);
      posts.forEach(post => {
        let ele = document.createElement('a');
        let name = document.createElement('span');
        if (post.img) {
          let imgWrapper = document.createElement('div');
          imgWrapper.className = 'postImg';
          ele.appendChild(imgWrapper);
          let img = new Image();
          img.onload = () => {
            imgWrapper.appendChild(img);
          };
          img.src = post.img;
        }

        ele.className = 'post';
        name.className = 'postTitle';
        name.innerText = post.title;
        ele.appendChild(name);
        ele.href = post.url;

        postsWrapper.appendChild(ele);
      });
      this.brain.info.classList.add('active');
    };
  }

  render(ctx, nextPoint, index) {
    this.ele.style.left = `${this.coord.x}px`;
    this.ele.style.top = `${this.coord.y}px`;
    if (Math.random() > 0.9) {
      this.ele.style.fontFamily = this.fonts[
        Math.floor(Math.random() * this.fonts.length)
      ];
    }

    if (index == this.brain.points.length - 1) {
      ctx.beginPath();
      ctx.moveTo(
        this.brain.points[0].coord.x + 25,
        this.brain.points[0].coord.y + 30
      );
    } else {
      ctx.lineTo(nextPoint.coord.x + 25, nextPoint.coord.y + 30);
    }
  }

  update() {
    if (this.canvasBoundsX()) {
      this.velocity.x *= -1;
    }

    if (this.canvasBoundsY()) {
      this.velocity.y *= -1;
    }

    this.coord.x += this.velocity.x;
    this.coord.y += this.velocity.y;
  }

  collision(nextPoint) {
    return (
      this.coord.x == nextPoint.coord.x || this.coord.y == nextPoint.coord.y
    );
  }

  canvasBoundsX() {
    return (
      this.coord.x > this.edges.right || this.coord.x < this.ele.offsetWidth
    );
  }

  canvasBoundsY() {
    return (
      this.coord.y > this.edges.bottom ||
      this.coord.y < this.ele.offsetHeight + 100
    );
  }
}
