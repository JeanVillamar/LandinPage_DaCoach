import { useEffect, useRef } from "react";
import type { ChatMessage } from "@/lib/chat-api";

interface ChatTranscriptProps {
  messages: ChatMessage[];
  isSending: boolean;
}

export default function ChatTranscript({ messages, isSending }: ChatTranscriptProps) {
  const bottomRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    bottomRef.current?.scrollIntoView({ behavior: "smooth", block: "end" });
  }, [messages, isSending]);

  return (
    <div className="mx-auto max-h-[420px] max-w-2xl overflow-y-auto rounded-2xl border border-bg-300 bg-bg-100 p-5 text-left custom-scrollbar">
      <div className="flex flex-col gap-4">
        {messages.map((message, index) => (
          <div key={index} className={`flex ${message.role === "user" ? "justify-end" : "justify-start"}`}>
            <div
              className={`max-w-[85%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed ${
                message.role === "user" ? "bg-accent text-white" : "bg-bg-200 text-text-100"
              }`}
            >
              {message.content}
            </div>
          </div>
        ))}

        {isSending && (
          <div className="flex justify-start">
            <div className="flex items-center gap-1.5 rounded-2xl bg-bg-200 px-4 py-3">
              <span className="h-1.5 w-1.5 animate-bounce rounded-full bg-text-400 [animation-delay:-0.3s]" />
              <span className="h-1.5 w-1.5 animate-bounce rounded-full bg-text-400 [animation-delay:-0.15s]" />
              <span className="h-1.5 w-1.5 animate-bounce rounded-full bg-text-400" />
            </div>
          </div>
        )}
      </div>
      <div ref={bottomRef} />
    </div>
  );
}
