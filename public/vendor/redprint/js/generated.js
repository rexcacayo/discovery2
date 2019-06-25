  var token = document.head.querySelector('meta[name="csrf-token"]');
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

  var app = new Vue({
      el: '#app',
      data: function () {
        return {
          cruds: [],
          editorVisible: false,
          filePath: '',
          fileContent: '',
          editorTheme: 'kuroir',
          editor: '',
          message: '',
          saving: false,
          loading: true,
        }
      },
      computed: {

      },
      mounted: function () {
        this.loadCruds()
      },
      methods:{
        loadCruds: function () {
          var self = this
          axios.get('/redprint/cruds')
            .then(function (response) {
              self.cruds = response.data
              if (self.cruds.length === 0) {
                self.message = 'No generated CRUDs found.'
              }
              self.loading = false
            })
            .catch(function (response) {
              self.loading = false
              self.message = 'Something went wrong while retrieving generated cruds. Please refresh and retry.'
              console.log(JSON.stringify(response))
            })
        },
        undo: function (crud) {

          var self  = this
          var confirmationText = 'This will permanently delete the CRUD. Action not reversible. Continue?'
          this.$confirm(confirmationText, 'Warning', {
            confirmButtonText: 'Yes. Remove.',
            cancelButtonText: 'Cancel',
            type: 'warning'
          }).then(() => {

            if (window.redprint_demo) {
              self.$message.error('FEATURE DISABLED FOR DEMO.')
              self.saving = false
              return false
            }
            axios.post('/redprint/rollback', crud)
              .then(function (response) {
                self.loadCruds()
                self.$message({
                  type: 'success',
                  message: 'CRUD Removed.'
                })
              })
              .catch(function (response) {
                console.log(JSON.stringify(response))
                self.$message({
                  type: 'error',
                  message: 'Faied to remove CRUD.'
                })
              })

          }).catch(() => {
            this.$message({
              type: 'info',
              message: 'Cancelled.'
            })         
          })

          // console.log(JSON.stringify(crud))

        },
        themeNavLink: function (theme) {
          return this.editorTheme === theme ? 'nav-link active' : 'nav-link'
        },
        fileListItemClass: function (path) {
          return this.filePath === path ? 'list-group-item active' : 'list-group-item'
        },
        initEditor: function () {
          this.editor = ''
          this.editor = ace.edit('editor')
          this.editor.setTheme('ace/theme/kuroir')
          this.editor.session.setMode('ace/mode/html')
        },
        changeTheme: function (theme) {
          this.editorTheme = theme
          this.editor.setTheme('ace/theme/' + theme)
        },
        loadFile: function (filePath, lang = 'php') {
          this.editorVisible = true
          this.$nextTick(function () {
            this.initEditor()
          })
          var self = this
          this.filePath = filePath
          if (this.filePath.indexOf('blade.php') !== -1) {
            lang = 'html'
          }
          var route = '/redprint/code-editor/get-file-content'
          axios.post(route, { path: filePath, lang: lang })
            .then(function (response) {
              self.saving = false
              self.fileContent = response.data.content
              self.editor.session.setMode('ace/mode/' + lang)
              self.editor.setValue(self.fileContent)
            })
            .catch(function (response) {
              self.$message.error('Error loading file...')
              console.log(JSON.stringify(response))
            })
          // console.log(filePath)
        },
        saveChanges: function () {
          var self = this
          this.saving = true

          // Make sure there are no syntax errors
          var hasError = false
          var annotations = this.editor.getSession().getAnnotations()
          for(var i=0; i < annotations.length; i++) {
            if(annotations[i]['type'] === 'error') {
              hasError = true
            }
          }

          if(hasError) {
            this.$message.error('You have syntax errors in your code! Please fix them and try again.')
            self.saving = false
            return false
          }
            
          if (window.redprint_demo) {
            self.$message.error('FEATURE DISABLED FOR DEMO.')
            self.saving = false
            return false
          }

          // Save changes
          var route = '/redprint/code-editor/put-file-content'
          var content = this.editor.getValue()
          axios.post(route, { path: this.filePath, content: content })
            .then(function (response) {
              self.$message.success('File saved!')
              self.saving = false
            })
            .catch(function (response) {
              console.log(JSON.stringify(response))
              self.$message.error('Error saving file...')
              self.saving = false
            })
        },
        handleClose: function () {
          this.editorVisible = false
          this.fileContent = ''
          this.filePath = ''
        }
      },
      components: {
      }
  });