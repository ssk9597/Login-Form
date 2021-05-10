<template>
  <div class="register-container">
    <ValidationObserver v-slot="{ invalid }">
      <form class="register-wrapper" @submit.prevent="registerUser()">
        <h2 class="register-title">新規登録</h2>
        <div v-if="errors" class="register-alert-red">
          <p v-if="errors.name">{{ errors.name[0] }}</p>
          <p v-if="errors.email">{{ errors.email[0] }}</p>
          <p v-if="errors.password">{{ errors.password[0] }}</p>
        </div>
        <!-- 姓 -->
        <label class="register-label">
          <span class="register-label-check">必須</span>
          <span class="register-label-name">姓</span>
        </label>
        <ValidationProvider class="register-input" name="姓" rules="required" v-slot="{ errors }">
          <input
            class="register-input-area"
            type="text"
            placeholder="例）田中"
            v-model="lastName"
          />
          <p class="register-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- 名 -->
        <label class="register-label">
          <span class="register-label-check">必須</span>
          <span class="register-label-name">名</span>
        </label>
        <ValidationProvider class="register-input" name="名" rules="required" v-slot="{ errors }">
          <input
            class="register-input-area"
            type="text"
            placeholder="例）太郎"
            v-model="firstName"
          />
          <p class="register-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- メールアドレス -->
        <label class="register-label">
          <span class="register-label-check">必須</span>
          <span class="register-label-name">メールアドレス</span>
        </label>
        <ValidationProvider
          class="register-input"
          name="メールアドレス"
          rules="required|email"
          v-slot="{ errors }"
        >
          <input
            class="register-input-area"
            type="email"
            placeholder="例）taro@example.com"
            v-model="email"
          />
          <p class="register-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- パスワード -->
        <label class="register-label">
          <span class="register-label-check">必須</span>
          <span class="register-label-name">パスワード</span>
        </label>
        <ValidationProvider
          class="register-input"
          name="パスワード"
          rules="required|min:8|alpha_dash"
          v-slot="{ errors }"
        >
          <input
            class="register-input-area"
            type="password"
            placeholder="例）taroTanaka"
            v-model="password"
          />
          <p class="register-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <!-- 新規追加 -->
        <button class="register-button" type="submit" :disabled="invalid">新規登録</button>
      </form>
    </ValidationObserver>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, useContext } from '@nuxtjs/composition-api';

export default defineComponent({
  setup(props, context) {
    // axios
    const { $axios } = useContext();
    // router
    const router = context.root.$router;
    // data
    const lastName = ref<string>('');
    const firstName = ref<string>('');
    const email = ref<string>('');
    const password = ref<string>('');
    const errors = ref<string>('');

    // computed
    const name = computed(() => {
      return `${lastName.value} ${firstName.value}`;
    });

    // methods
    const registerUser = async () => {
      try {
        // 新規登録
        await $axios.post('/users/register', {
          name: name.value,
          email: email.value,
          password: password.value,
        });

        // ログイン
        const res = await $axios.post('/users/login', {
          email: email.value,
          password: password.value,
        });

        // token
        await $axios.setToken(res.data.token, 'Bearer');

        router.push('/');
      } catch (err) {
        errors.value = err.response.data.errors;
      }
    };

    return {
      // data
      lastName,
      firstName,
      email,
      password,
      errors,
      // computed
      name,
      // methods
      registerUser,
    };
  },
});
</script>

<style lang="scss" scoped>
.register {
  &-container {
    position: relative;
    height: 100vh;
    width: 100%;
    background-color: #eeeeee;
  }

  &-wrapper {
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(-50%);
    max-width: 400px;
    width: 100%;
    background-color: #fff;
    border-radius: 10px;
    padding: 50px 50px;
  }

  &-title {
    text-align: center;
    padding-bottom: 20px;
  }

  &-alert-red {
    padding: 5px 10px;
    background: #ffebee;
    margin-bottom: 10px;
    font-size: 12px;
  }

  &-label {
    &-check {
      background-color: #ee4056;
      color: #fff;
      padding: 3px 10px;
      border-radius: 10%;
      font-size: 0.75rem;
      font-weight: 600;
    }
    &-name {
      font-size: 0.8rem;
      padding: 5px;
    }
  }

  &-input {
    padding-top: 10px;
    padding-bottom: 15px;
    display: block;

    &-area {
      box-sizing: border-box;
      width: 100%;
      padding: 10px;
      font-size: 14px;
      color: #303030;
      border: solid 1px #eee;
      border-radius: 6px;
      outline: 0;
      transition: 0.3s;
    }

    &-error {
      padding-top: 5px;
      font-size: 12px;
      color: #ee4056;
      font-weight: 600;
    }
  }

  &-button {
    margin-top: 20px;
    width: 100%;
    height: 40px;
    color: #fff;
    background: #40c7c1;
    text-decoration: none;
    border: none;
    outline: none;
    border-radius: 8px;
    cursor: pointer;
    appearance: none;
    transition: 0.2s;

    &:hover {
      background: #78cec8;
    }
  }
}
</style>
