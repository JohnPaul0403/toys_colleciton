---
paths:
  - 'resources/js/components/toys/**'
---

# Toys

## Tiptap editor content needs typography CSS
Tailwind preflight strips heading sizes/weights, list bullets, and blockquote styling inside the Tiptap editor. The form's description uses a plain `<EditorContent>` from @tiptap/vue-3 and relies on `.tiptap.ProseMirror` rules in resources/css/app.css for all block formatting (headings, lists, blockquote, code blocks, hr). Keep those rules scoped to .tiptap.ProseMirror; don't add the prebuilt `ui/tiptap` suite (its index imports missing @atlaskit packages).

## Toy form description editor (tiptap + image)
Description editor is a plain @tiptap/vue-3 EditorContent with StarterKit + @tiptap/extension-image (allowBase64: true). Images are inserted by URL via the toolbar button (window.prompt -> setImage). There is no file-upload endpoint yet. Block-level styling relies on .tiptap.ProseMirror rules in resources/css/app.css because Tailwind preflight strips heading/list/blockquote styles.
