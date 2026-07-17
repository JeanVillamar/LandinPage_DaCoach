export interface ChatMessage {
  role: "user" | "assistant";
  content: string;
}

const API_URL = import.meta.env.VITE_CHAT_API_URL || "/api/chat";

export async function sendChatMessage(messages: ChatMessage[]): Promise<string> {
  const response = await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ messages }),
  });

  const data = await response.json().catch(() => null);

  if (!response.ok) {
    throw new Error(data?.error ?? "No se pudo obtener respuesta del asistente.");
  }

  return data.reply as string;
}
