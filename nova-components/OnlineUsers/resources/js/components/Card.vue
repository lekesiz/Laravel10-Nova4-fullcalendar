<template>
  <card class="mb-6">
    <div class="text-center">
      <br />
      <h1 class="text-90 font-normal mb-3">{{ users.length }} Utilisateurs en ligne</h1>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }} {{ user.last_name }}</li>
      </ul>
    </div>
  </card>
</template>

<script>
export default {
  props: ['card'],

  data() {
    return {
      users: []
    };
  },

  mounted() {
    this.getOnlineUsers();
  },

  methods: {
    getOnlineUsers() {
      Nova.request()
        .get('/nova-vendor/online_users/online-users')
        .then(response => {
          this.users = response.data;
        });
    }
  }
};
</script>
