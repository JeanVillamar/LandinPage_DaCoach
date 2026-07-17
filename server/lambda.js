import { getChatReply } from "./chatService.js";
import { validateMessages } from "./validateMessages.js";

const CORS_HEADERS = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "Content-Type",
  "Access-Control-Allow-Methods": "POST, OPTIONS",
};

function jsonResponse(statusCode, payload) {
  return {
    statusCode,
    headers: { "Content-Type": "application/json", ...CORS_HEADERS },
    body: JSON.stringify(payload),
  };
}

// Handler para una AWS Lambda Function URL (payload format 2.0).
// Si el Function URL ya tiene CORS configurado en AWS, estos headers son redundantes pero inofensivos.
export async function handler(event) {
  const method = event.requestContext?.http?.method ?? "POST";

  if (method === "OPTIONS") {
    return { statusCode: 204, headers: CORS_HEADERS, body: "" };
  }

  let body;
  try {
    const rawBody = event.isBase64Encoded ? Buffer.from(event.body ?? "", "base64").toString("utf-8") : event.body;
    body = JSON.parse(rawBody ?? "{}");
  } catch {
    return jsonResponse(400, { error: "El cuerpo de la solicitud debe ser JSON válido." });
  }

  const validationError = validateMessages(body.messages);
  if (validationError) {
    return jsonResponse(400, { error: validationError });
  }

  try {
    const reply = await getChatReply(body.messages);
    return jsonResponse(200, { reply });
  } catch (error) {
    console.error("Error al llamar a Groq:", error);
    return jsonResponse(502, { error: "No se pudo obtener respuesta del asistente. Intenta de nuevo." });
  }
}
