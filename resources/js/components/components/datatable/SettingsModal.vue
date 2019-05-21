<template>
    <div class="ui small modal" id="settingsModal">
        <div class="header">Settings</div>
        <div class="content ui form">
          <div class="field">
            <div class="ui checkbox">
              <input type="checkbox" v-model="$parent.multiSort">
              <label>Multisort (use Alt+Click)</label>
            </div>
          </div>
          <div class="inline fields">
            <div class="field">
              <div class="ui checkbox">
                <input type="checkbox" checked="$parent.tableHeight" @change="setTableHeight($event)">
                <label>Table Height</label>
              </div>
            </div>
            <div class="field">
              <input type="text" v-model="$parent.tableHeight">
            </div>
          </div>
          <div class="ui divider"></div>
          <div class="field">
            <label>Pagination:</label>
            <select class="ui simple dropdown" v-model="$parent.paginationComponent">
              <option value="vuetable-pagination">vuetable-pagination</option>
              <option value="vuetable-pagination-dropdown">vuetable-pagination-dropdown</option>
            </select>
          </div>
          <div class="field">
            <label>Per Page:</label>
            <select class="ui simple dropdown" v-model="$parent.perPage">
              <option :value="10">10</option>
              <option :value="15">15</option>
              <option :value="20">20</option>
              <option :value="25">25</option>
            </select>
          </div>
          <div class="ui fluid card">
            <div class="content">
              <div class="header">Visible fields</div>
            </div>
            <div v-if="vuetableFields" class="content">
              <div v-for="(field, idx) in vuetableFields" class="field">
                <div class="ui checkbox">
                  <input type="checkbox" :checked="field.visible" @change="toggleField(idx, $event)">
                  <label>{{ getFieldTitle(field) }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="actions">
          <div class="ui cancel button">Close</div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            vuetableFields:[]
        }
    },
    methods: {
        getFieldTitle (field) {
            if (typeof(field.title) === 'function') return field.title(true)
    
            let title = field.title
            if (title !== '') return this.stripHTML(title)
    
            title = ''
            if (field.name.slice(0, 2) === '__') {
            title = field.name.indexOf(':') >= 0
                ? field.name.split(':')[1]
                : field.name.replace('__', '')
            }
    
            return title
        },
        stripHTML (str) {
            return str ? str.replace(/(<([^>]+)>)/ig,"") : ''
        },
        toggleField (index, event) {
            console.log('toggleField: ', index, event.target.checked)
            this.$parent.$refs.vuetable.toggleField(index)
        },
        setTableHeight (event) {
            if (event.target.checked) {
            this.$parent.tableHeight = '600px'
            return
            }
    
            this.$parent.tableHeight = null
        }
    }
}
</script>