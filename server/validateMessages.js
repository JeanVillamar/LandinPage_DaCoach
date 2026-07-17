const MAX_MESSAGES = 30;
const MAX_MESSAGE_LENGTH = 4000;

export function validateMessages(messages) {
  if (!Array.isArray(messages) || messages.length === 0) {
    return "El campo 'messages' debe ser un array no vacío.";
  }
  if (messages.length > MAX_MESSAGES) {
    return `Se permiten como máximo ${MAX_MESSAGES} mensajes por conversación.`;
  }
  for (const m of messages) {
    if (!m || (m.role !== "user" && m.role !== "assistant")) {
      return "Cada mensaje debe tener role 'user' o 'assistant'.";
    }
    if (typeof m.content !== "string" || m.content.trim().length === 0) {
      return "Cada mensaje debe tener un content de texto no vacío.";
    }
    if (m.content.length > MAX_MESSAGE_LENGTH) {
      return `Cada mensaje debe tener como máximo ${MAX_MESSAGE_LENGTH} caracteres.`;
    }
  }
  return null;
}
