import Vue from 'vue'
import Icon from './Icon'
import EmailInput from './form/EmailInput'
import ProgressBar from './ProgressBar'
import PasswordInput from './form/PasswordInput'
import SubmitButton from './form/SubmitButton'
import TextInput from './form/TextInput'
import { HasError, AlertError, AlertSuccess } from 'vform'
import Name from './product/shutter/Name'
import Width from './product/shutter/Width'
import Drop from './product/shutter/Drop'
import ShutterType from './product/shutter/ShutterType'
import Corner from './product/shutter/Corner'
import InOrOut from './product/shutter/InOrOut'
import MidRail from './product/shutter/MidRail'
import PanelLayout from './product/shutter/PanelLayout'
import Notes from './product/shutter/Notes'


Vue.component(Icon.name, Icon)
Vue.component(EmailInput.name, EmailInput)
Vue.component(ProgressBar.name, ProgressBar)
Vue.component(PasswordInput.name, PasswordInput)
Vue.component(SubmitButton.name, SubmitButton)
Vue.component(TextInput.name, TextInput)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component(Name.name, Name)
Vue.component(Width.name, Width)
Vue.component(Drop.name, Drop)
Vue.component(ShutterType.name, ShutterType)
Vue.component(Corner.name, Corner)
Vue.component(InOrOut.name, InOrOut)
Vue.component(MidRail.name, MidRail)
Vue.component(PanelLayout.name, PanelLayout)
Vue.component(Notes.name, Notes)

