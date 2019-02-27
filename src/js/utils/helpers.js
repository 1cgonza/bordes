export function rand(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}

export function randInt(min, max) {
  return Math.random() * (max - min) + min;
}
