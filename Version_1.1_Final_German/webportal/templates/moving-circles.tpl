<style>
:root {
  --color-1: #6e40aa;
  --color-2: #4c6edb;
  --color-3: #24aad8;
  --color-4: #1ac7c2;
  --color-5: #1ddea3;
}

.shape {
  cy: 50;
  r: 20;
  animation: moveCircle 1250ms ease-in-out both infinite;
}

.shape:nth-child(1) {
  cx: 60;
  fill: var(--color-1);
}

.shape:nth-child(2) {
  cx: 120;
  fill: var(--color-2);
  animation-delay: 100ms;
}

.shape:nth-child(3) {
  cx: 180;
  fill: var(--color-3);
  animation-delay: 200ms;
}

.shape:nth-child(4) {
  cx: 240;
  fill: var(--color-4);
  animation-delay: 300ms;
}

.shape:nth-child(5) {
  cx: 300;
  fill: var(--color-5);
  animation-delay: 400ms;
}

@keyframes moveCircle {
  50% {
    cy: 150;
    r: 13;
  }
}
</style>
<svg xmlns="http://www.w3.org/2000/svg"
	version="1.1" baseProfile="full"
	width="350px" height="250px" viewBox="0 0 350 250">
  <circle class="shape" />
  <circle class="shape" />
  <circle class="shape" />
  <circle class="shape" />
  <circle class="shape" />
</svg>