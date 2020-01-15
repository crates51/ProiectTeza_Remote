export const Reusable = {
     template: '<div>{{ name }} {{ bar }} lol </div>',

      props: {
        name: {
          type: String
        }
      },
      
      data () {
        return {
          bar: 'Bar'
        }
      }
    };