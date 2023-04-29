import Card from './components/Card'

Nova.booting((app, store) => {
  app.component('online_users', Card)
})
