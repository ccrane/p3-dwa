{{ (old($field, null) != null) ? ((old($field) == $value) ? "selected" : "") : ((isset($$field) && ($$field == $value)) ? "selected" : "") }}
