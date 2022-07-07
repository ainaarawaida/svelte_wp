import App from './App.svelte'

var app;

if (document.getElementById('luq_vote_app') !== null) {
  app = new App({
    target: document.getElementById('luq_vote_app')
  })
}


export default app
