# Google reCAPTCHA validater for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chitranu/google-recaptcha.svg?style=flat-square)](https://packagist.org/packages/chitranu/google-recaptcha)
[![Total Downloads](https://img.shields.io/packagist/dt/chitranu/google-recaptcha.svg?style=flat-square)](https://packagist.org/packages/chitranu/google-recaptcha)

This package is a wrapper around [Google's reCAPTCHA PHP client library](https://github.com/google/recaptcha). It provides a handy validation rule `recaptcha`, which can be used to validate the reCAPTCHA token in the form requests.

You can use this package with any of reCAPTCHA types:

- Google reCAPTCHA v2
- Google reCAPTCHA v3

## Installation

You can install the package via composer:

```bash
composer require chitranu/google-recaptcha
```

## Usage

Get Google reCAPTCHA secret key for your application from [https://www.google.com/recaptcha/admin/](https://www.google.com/recaptcha/admin/) and place it inside `.env` file at the root like this.

```env
GOOGLE_RECAPTCHA_SECRETKEY=YOUR_RECAPTCHA_SECRET_KEY
```

After setting secret key, head over to your request validator, and add a field with rule the `recaptcha` like below to validate the token received in the form request.

```php
$request->validate([
    '...' // other fields
    'recaptcha-token' => 'required|recaptcha'
]);
```

### Setting score threshold

If you are getting a lot of spam submissions. You can take advantage of setting the score threshold while specifying the validation rule by setting a value between `0.1 - 1.0`. Read more about score threshold here:: [https://developers.google.com/recaptcha/docs/v3#interpreting_the_score](https://developers.google.com/recaptcha/docs/v3#interpreting_the_score)

```php
$request->validate([
    '...' // other fields
    'recaptcha-token' => 'required|recaptcha:0.5' // Specify threshhold
]);
```

## Examples

### Using in frontend (vue-recaptcha-v3 plugin)

This package is intended to use with [vue-recaptcha-v3](https://github.com/AurityLab/vue-recaptcha-v3) npm plugin. You can use it by creating a Vue form component using `vue-recaptcha-v3` plugin shown below.

Register your site key with the `vue-recaptcha-v3` plugin:

```js
import Vue from "vue";
import { VueReCaptcha } from "vue-recaptcha-v3";

Vue.use(VueReCaptcha, { siteKey: "YOUR_GOOGLE_SITE_KEY" });
```

Create a Vue component for the form and submit reCAPTCHA token using form like this:

```vue
<template>
  <form @submit.prevent="onFormSubmit()" ref="contactform">
    <input type="text" name="name" placeholder="Your Name" />
    <input type="email" name="email" placeholder="Your Email" />
    <textarea name="message" placeholder="Your Message"></textarea>
    <button type="submit">Submit</button>
  </form>
</template>

<script>
export default {
  methods: {
    async onFormSubmit() {
      // Wait until recaptcha has been loaded.
      await this.$recaptchaLoaded();

      // Execute reCAPTCHA with action "login".
      const token = await this.$recaptcha("login");

      // Prepare form data
      let formData = new FormData(this.$refs.contactform);

      // Appended token in formData
      formData.append("recaptcha-token", token);

      // Make an ajax request to your Laravel endpoint.
      axios.post("/your-form-endpoint", formData).then(
        (response) => {
          // handle response
        },
        (error) => {
          // handle errors
        }
      );
    },
  },
};
</script>
```

### Using in frontend (vue-recaptcha plugin)

If you are using [vue-recaptcha](https://github.com/DanSnow/vue-recaptcha) plugin (older version), you can still use it by creating a vue form component shown below:

```vue
<template>
  <form @submit.prevent="onFormSubmit()" ref="contactform">
    <input type="text" name="name" placeholder="Your Name" />
    <input type="email" name="email" placeholder="Your Email" />
    <textarea name="message" placeholder="Your Message"></textarea>
    <vue-recaptcha
      ref="recaptcha"
      @verify="onCaptchaVerified"
      @expired="resetCaptcha"
      :sitekey="sitekey"
      :loadRecaptchaScript="true"
    />
    <button type="submit">Submit</button>
  </form>
</template>

<script>
import VueRecaptcha from "vue-recaptcha";

export default {
  components: {
    VueRecaptcha,
  },
  computed: {
    sitekey() {
      return "YOUR_GOOGLE_RECAPTHCA_SITE_KEY";
    },
  },
  methods: {
    onFormSubmit() {
      this.$refs.recaptcha.execute();
    },
    onCaptchaVerified(token) {
      // Prepare form data
      const formData = new FormData(this.$refs.contactform);

      // Appended token in formData
      formData.append("recaptcha-token", token);

      // Make an ajax request to your Laravel endpoint.
      axios.post("/your-form-endpoint", formData).then(
        (response) => {
          // handle response
        },
        (error) => {
          // handle errors
        }
      );
    },
    resetCaptcha() {
      this.$refs.recaptcha.reset();
    },
  },
};
</script>
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email `swapnil@chitranu.com` instead of using the issue tracker.

## Credits

- [Swapnil Bhavsar](https://github.com/iamswap)
- [Rajesh Dewle](https://github.com/rajeshdewle)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
