<style>
.shape {
  animation: moveCircle 1250ms ease-in-out both infinite;
}

#shape2 {
  animation-delay: 100ms;
}

#shape3 {
  animation-delay: 200ms;
}

#shape4 {
  animation-delay: 300ms;
}

#shape5 {
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
  <circle class="shape" id="shape1" cx="60" cy="50" r="20" style="fill: #444444;" />
  <circle class="shape" id="shape2" cx="120" cy="50" r="20" style="fill: #888888;" />
  <circle class="shape" id="shape3" cx="180" cy="50" r="20" style="fill: #bbbbbb;" />
  <circle class="shape" id="shape4" cx="240" cy="50" r="20" style="fill: #888888;" />
  <circle class="shape" id="shape5" cx="300" cy="50" r="20" style="fill: #444444;" />
</svg>